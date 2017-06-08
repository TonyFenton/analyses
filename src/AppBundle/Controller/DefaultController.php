<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Form\SwotType;
use AppBundle\Form\FileType;
use AppBundle\Entity\Matrices\Form\SwotForm;
use AppBundle\Entity\Matrices\File;
use AppBundle\Entity\Matrices\Standard\MatrixStandard;
use AppBundle\Utils\Matrices\Swot;

class DefaultController extends Controller
{
    private $request = null;
    private $response = null;
    private $redirect = '';
    private $form = null;
    private $matrix = null;

    /**
     * @Route("/", name="en_homepage")
     * @Route("/pl/", defaults={"_locale": "pl"}, name="pl_homepage")
     */
    public function indexAction(Request $request)
    {
        $header = 'some header';

        return $this->render('default/index.html.twig', [
            'header' => $header,
        ]);
    }

    /**
     * @Route("/swot-analysis/upload", name="en_upload")
     * @Route("/pl/analiza-swot/wczytaj", defaults={"_locale": "pl"}, name="pl_upload")
     */
    public function uploadAction(Request $request)
    {
        $locale = $request->getLocale();
        $form = $this->createForm(FileType::class, new File(), ['action' => $this->generateUrl($locale.'_swot')]);

        return $this->render('default/upload_file.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/swot-analysis/{id}", requirements={"id": "\d+"}, defaults={"id": 0}, name="en_swot")
     * @Route("/pl/analiza-swot/{id}", requirements={"id": "\d+"}, defaults={"_locale": "pl", "id": 0}, name="pl_swot")
     */
    public function swotAction(Request $request, int $id)
    {
        $this->request = $request;
        $this->matrix = new Swot();
        $this->form = $this->createForm(SwotType::class, null, ['translator' => $this->get('translator')]);

        if ($request->request->has('swot')) {
            $this->handleMatrixForm();
        } elseif ($request->request->has('file')) {
            $this->handleFileMatrix();
        } elseif ($id) {
            $this->handleDatabaseMatrix($id);
        } else {
            // show empty matrix
        }

        if ($this->redirect) {
            $this->response = $this->redirect;
        } elseif (is_null($this->response)) {
            $this->response = $this->render('default/swot.html.twig', [
                'form' => $this->form->createView(),
                'matrixview' => $this->matrix->getView(),
            ]);
        }

        return $this->response;
    }

    private function handleMatrixForm()
    {
        $this->form->setData(new SwotForm());
        $this->form->handleRequest($this->request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->matrix->setForm($this->form->getData());
            if ($this->form->get('text')->isClicked()) {
                $this->response = $this->createFileResponse($this->matrix->getStandard()->getName(), 'txt',
                    $this->matrix->getText());
            } elseif ($this->form->get('json')->isClicked()) {
                $this->response = $this->createFileResponse($this->matrix->getStandard()->getName(), 'json',
                    $this->matrix->getJson());
            } else {
                throw new \LogicException('This should never be reached!');
            }
        }
    }

    private function handleDatabaseMatrix(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $matrix = $em->getRepository(MatrixStandard::class)->find($id);
        if (!$matrix) {
            throw new NotFoundHttpException('Not found');
        }
        $this->matrix->setMatrixStandard($matrix);
        $this->form->setData($this->matrix->getForm());
    }

    private function handleFileMatrix()
    {
        $redirect = $this->redirectToRoute($this->request->getLocale().'_upload');
        $file = new File();
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
            $this->addFlash('danger', trim((string)$fileForm->getErrors(true)));
            $this->redirect = $redirect;
        }
    }

    private function createFileResponse(string $name, string $extension, string $content): Response
    {
        $spaceless = preg_replace('/\s/ ', '_', trim($name));
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $spaceless);
        $filename = preg_replace("/[^a-zA-Z0-9_-]/", '', substr($ascii, 0, 45)).'.'.$extension;

        $response = new Response($content);
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}