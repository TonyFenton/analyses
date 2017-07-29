<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Form\Form;
use AppBundle\Form\SwotType;
use AppBundle\Form\FileType;
use AppBundle\Entity\Matrix\Forms\SwotForm;
use AppBundle\Entity\Matrix\Forms\FileForm;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Page\Page;
use AppBundle\Utils\Matrix\Swot;

class MatrixController extends Controller
{
    private $request = null;
    private $response = null;
    private $redirect = null;
    private $form = null;
    private $matrix = null;

    /**
     * @Route("/swot-analysis/load-from-file", name="en_upload")
     * @Route("/analiza-swot/wczytaj-z-pliku", defaults={"_locale": "pl"}, name="pl_upload")
     */
    public function uploadAction(Request $request)
    {
        $locale = $request->getLocale();
        $form = $this->createForm(FileType::class, new FileForm(), ['action' => $this->generateUrl($locale.'_swot')]);

        return $this->render('matrix/upload_file.html.twig', [
            'form' => $form->createView(),
            'page' => $this->getDoctrine()->getManager()->getRepository(Page::class)->findOneByRoute($request->get('_route')),
        ]);
    }

    /**
     * @Route("/swot-analysis/{id}", requirements={"id": "\d+"}, defaults={"id": 0}, name="en_swot")
     * @Route("/analiza-swot/{id}", requirements={"id": "\d+"}, defaults={"_locale": "pl", "id": 0}, name="pl_swot")
     */
    public function swotAction(Request $request, int $id)
    {
        $this->request = $request;
        $this->matrix = new Swot($this->getDoctrine()->getManager());
        $this->form = $this->createForm(SwotType::class, null, ['translator' => $this->get('translator')]);

        if ($request->request->has('swot')) {
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
        } elseif (is_null($this->response)) {
            $this->response = $this->render('matrix/swot.html.twig', [
                'form' => $this->form->createView(),
                'matrixview' => $this->matrix->getView(),
                'page' => $this->getDoctrine()->getManager()->getRepository(Page::class)->findOneByRoute($request->get('_route')),
            ]);
        }

        return $this->response;
    }

    private function handleMatrixForm(int $id = 0)
    {
        $matrix = new SwotForm();
        $this->form->setData($matrix);
        $this->form->handleRequest($this->request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->matrix->setForm($this->form->getData());
            $name = $this->matrix->getMatrix()->getName();
            if ($this->form->get('text')->isClicked()) {
                $this->response = $this->createFileResponse('text/plain', $name, $this->matrix->getText());
            } elseif ($this->form->get('json')->isClicked()) {
                $this->response = $this->createFileResponse('application/json', $name, $this->matrix->getJson());
            } elseif ($this->form->get('jpg')->isClicked()) {
                $this->setImgResponse('image/jpeg', $name, $matrix->getCanvas());
            } elseif ($this->form->get('png')->isClicked()) {
                $this->setImgResponse('image/png', $name, $matrix->getCanvas());
            } elseif ($this->form->get('save')->isClicked()) {
                if ($this->getUser()) {
                    $this->saveMatrix($id);
                } else {
                    $this->addFlash('warning', 'matrix.not_logged_in');
                }
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
        $dbMatrix = $em->getRepository(Matrix::class)->findOneBy(['id' => $id, 'user' => $this->getUser()]);
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
        $redirect = $this->redirectToRoute($this->request->getLocale().'_upload');
        $file = new FileForm();
        $fileForm = $this->createForm(FileType::class, $file);
        $fileForm->handleRequest($this->request);
        if ($fileForm->isSubmitted() && $fileForm->isValid()) {
            $file = $file->getFile();
            try {
                switch ($file->getClientOriginalExtension()) {
                    case 'json':
                        $this->matrix->setJson(file_get_contents($file));
                        break;
                    case 'txt':
                        $this->matrix->setText(file_get_contents($file));
                        break;
                    default:
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
        $this->redirect = $this->redirectToRoute($this->request->get('_route'),
            ['id' => $this->matrix->getMatrix()->getId()]);
        $this->addFlash('success', $message);
    }

    private function createFileResponse(string $type, string $name, string $content): Response
    {
        $spaceless = preg_replace('/\s/ ', '_', trim($name));
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $spaceless);
        $filename = preg_replace("/[^a-zA-Z0-9_-]/", '', substr($ascii, 0, 45)).'.'.$this->getExtension($type);

        $response = new Response($content);
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $filename);
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', $type);

        return $response;
    }

    private function getExtension(string $contentType): string
    {
        switch ($contentType) {
            case 'text/plain':
                $extension = 'txt';
                break;
            case 'application/json':
                $extension = 'json';
                break;
            case 'image/jpeg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'text/html':
                $extension = 'html';
                break;
            case 'application/pdf':
                $extension = 'pdf';
                break;
            default:
                throw new \InvalidArgumentException('Wrong contentType argument, got "'.$contentType.'"');
        }

        return $extension;
    }

    private function setImgResponse(string $type, string $name, string $canvas)
    {
        $this->response = $this->createFileResponse(
            $type,
            $name,
            base64_decode(explode(",", $canvas)[1])
        );
    }

    private function transformFormErrorsToFlashMessages(Form $form)
    {
        foreach ($form->getErrors(true) as $error) {
            $this->addFlash('danger', $error->getMessage());
        }
    }
}