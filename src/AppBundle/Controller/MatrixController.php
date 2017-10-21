<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use AppBundle\Form\FileType;
use AppBundle\Entity\Matrix\Forms\FileForm;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Matrix\Type;
use AppBundle\Entity\Page\Page;
use AppBundle\Utils\Matrix\AbstractMatrix;

class MatrixController extends Controller
{
    private $request = null;
    private $response = null;
    private $redirect = null;
    private $form = null;

    /**
     * @var AbstractMatrix
     */
    private $matrix;

    /**
     * @var string
     */
    private $matrixType;

    /**
     * @Route("/swot-analysis/load-from-file", defaults={"matrixType": "swot"}, name="en_swot_upload")
     * @Route("/analiza-swot/wczytaj-z-pliku", defaults={"_locale": "pl", "matrixType": "swot"}, name="pl_swot_upload")
     * @Route("/pest-analysis/load-from-file", defaults={"matrixType": "pest"}, name="en_pest_upload")
     * @Route("/analiza-pest/wczytaj-z-pliku", defaults={"_locale": "pl", "matrixType": "pest"}, name="pl_pest_upload")
     */
    public function uploadAction(Request $request, string $matrixType)
    {
        $locale = $request->getLocale();
        $form = $this->createForm(FileType::class, new FileForm(),
            ['action' => $this->generateUrl($locale.'_'.$matrixType)]);

        return $this->render('matrix/upload_file.html.twig', [
            'form' => $form->createView(),
            'page' => $this->getDoctrine()->getManager()->getRepository(Page::class)->findOneByRoute($request->get('_route')),
        ]);
    }

    /**
     * @Route("/swot-analysis/{id}", requirements={"id": "\d+"}, defaults={"matrixType": "swot", "id": 0}, name="en_swot")
     * @Route("/analiza-swot/{id}", requirements={"id": "\d+"}, defaults={"_locale": "pl", "matrixType": "swot", "id": 0}, name="pl_swot")
     * @Route("/pest-analysis/{id}", requirements={"id": "\d+"}, defaults={"matrixType": "pest", "id": 0}, name="en_pest")
     * @Route("/analiza-pest/{id}", requirements={"id": "\d+"}, defaults={"_locale": "pl", "matrixType": "pest", "id": 0}, name="pl_pest")
     */
    public function matrixAction(Request $request, string $matrixType, int $id)
    {
        $this->request = $request;
        $this->matrixType = $matrixType;
        $this->matrix = AbstractMatrix::createMatrix($matrixType, $this->getDoctrine()->getManager());
        $formType = "AppBundle\Form\\".ucfirst($this->matrixType).'Type';
        $this->form = $this->createForm($formType, null, ['translator' => $this->get('translator')]);

        if ($request->request->has($this->matrixType)) {
            $this->handleMatrixForm($id);
        } elseif ($request->request->has('file')) {
            $this->handleMatrixFile();
        } elseif ($id) {
            $this->handleMatrixDatabase($id);
        } else {
            // show empty matrix
        }

        if ($this->redirect) {
            $this->response = $this->redirect;
        } elseif (null === $this->response) {
            $this->response = $this->render('matrix/'.ucfirst($this->matrixType).'.html.twig', [
                'form' => $this->form->createView(),
                'matrixview' => $this->matrix->getView(),
                'page' => $this->getDoctrine()->getManager()->getRepository(Page::class)->findOneByRoute($request->get('_route')),
            ]);
        }

        return $this->response;
    }

    private function handleMatrixForm(int $id = 0)
    {
        $matrixForm = "AppBundle\Entity\Matrix\Forms\\".ucfirst($this->matrixType).'Form';
        $matrix = new $matrixForm();
        $this->form->setData($matrix);
        $this->form->handleRequest($this->request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->matrix->setForm($this->form->getData());
            if ($this->isClicked('text')) {
                $this->setFileResponse('text/plain', $this->matrix->getText());
            } elseif ($this->isClicked('json')) {
                $this->setFileResponse('application/json', $this->matrix->getJson());
            } elseif ($this->isClicked('jpg')) {
                $this->setFileResponse('image/jpeg', $matrix->getCanvas(), true);
            } elseif ($this->isClicked('png')) {
                $this->setFileResponse('image/png', $matrix->getCanvas(), true);
            } elseif ($this->isClicked('html')) {
                $this->setFileResponse('text/html', $this->matrix->getHtml());
            } elseif ($this->isClicked('save')) {
                $this->saveMatrix($id);
            } else {
                throw new \LogicException('This should never be reached!');
            }
        } else {
            $this->transformFormErrorsToFlashMessages($this->form);
        }
    }

    private function handleMatrixDatabase(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dbMatrix = $em->getRepository(Matrix::class)->findOneBy([
            'id' => $id,
            'user' => $this->getUser(),
            'type' => $this->matrix->getType(),
        ]);
        if ($dbMatrix) {
            $this->matrix->setMatrix($dbMatrix);
            $this->form->setData($this->matrix->getForm());
        } else {
            $this->addFlash('warning', 'matrix.not_found');
            $this->redirect = $this->redirectToRoute($this->request->get('_route'));
        }
    }

    private function handleMatrixFile()
    {
        $redirect = $this->redirectToRoute($this->request->getLocale().'_'.$this->matrixType.'_upload');
        $file = new FileForm();
        $fileForm = $this->createForm(FileType::class, $file);
        $fileForm->handleRequest($this->request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $file = $file->getFile();
            try {
                if ('json' === $file->getClientOriginalExtension()) {
                    $this->matrix->setJson(file_get_contents($file));
                } elseif ('txt' === $file->getClientOriginalExtension()) {
                    $this->matrix->setText(file_get_contents($file));
                } else {
                    throw new \InvalidArgumentException('exception.wrong_file_extension');
                }
                $this->form->setData($this->matrix->getForm());
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
                $this->redirect = $redirect;
            }
        } else {
            $this->transformFormErrorsToFlashMessages($fileForm);
            $this->redirect = $redirect;
        }
    }

    private function saveMatrix(int $id = 0)
    {
        if ($this->getUser()) {
            $this->matrix->getMatrix()->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            if ($id && $dbMatrix = $em->getRepository(Matrix::class)->findOneBy([
                    'id' => $id,
                    'user' => $this->getUser(),
                ])
            ) {
                foreach ($dbMatrix->getCells() as $cell) {
                    $em->remove($cell);
                }
                $this->matrix->getMatrix()->setCreated($dbMatrix->getCreated());
                $em->merge($this->matrix->getMatrix()->setId($id));
                $message = 'matrix.merge';
            } else {
                $em->persist($this->matrix->getMatrix());
                $message = 'matrix.persist';
            }
            $em->flush();
            $this->redirect = $this->redirectToRoute(
                $this->request->get('_route'),
                ['id' => $this->matrix->getMatrix()->getId()]
            );
            $this->addFlash('success', $message);
        } else {
            $this->addFlash('warning', 'matrix.not_logged_in');
        }
    }

    private function transformFormErrorsToFlashMessages(Form $form)
    {
        foreach ($form->getErrors(true) as $error) {
            $this->addFlash('danger', $error->getMessage());
        }
    }

    private function setFileResponse(string $type, string $content, bool $fromCanvas = false)
    {
        $method = $fromCanvas ? 'createAttachmentResponseFromCanvas' : 'createAttachmentResponse';
        $this->response = $this->get('app_bundle.utils.file_response')->$method(
            $type,
            $this->matrix->getMatrix()->getName(),
            $content
        );
    }

    private function isClicked(string $button): bool
    {
        return $this->form->has($button) && $this->form->get($button)->isClicked();
    }
}
