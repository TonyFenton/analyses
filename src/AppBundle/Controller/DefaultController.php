<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use  AppBundle\Form\SwotType;
use AppBundle\Utils\Matrices\Swot;
use AppBundle\Form\FileType;
use AppBundle\Entity\Matrices\File;

class DefaultController extends Controller
{
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
     * @Route("/swot-analysis", name="en_swot")
     * @Route("/pl/analiza-swot", defaults={"_locale": "pl"}, name="pl_swot")
     */
    public function swotAction(Request $request)
    {
        $swot = new Swot(null);

        $form = $this->createForm(SwotType::class, $swot->getForm(), ['translator' => $this->get('translator')]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $swot = new Swot($form->getData());
            if ($form->get('text')->isClicked()) {
                $response = $this->createFileResponse($swot->getStandard()->getName(), 'txt', $swot->getText());
            } elseif ($form->get('json')->isClicked()) {

                $response = $this->createFileResponse($swot->getStandard()->getName(), 'json', $swot->getJson());

            } else {
                exit('else');
            }

            return $response;
        }

        return $this->render('default/swot.html.twig', [
            'form' => $form->createView(),
            'matrixview' => $swot->getView(),
        ]);
    }


    /**
     * @Route("/swot-analysis/upload", name="en_swot_upload")
     * @Route("/pl/analiza-swot/wczytaj", defaults={"_locale": "pl"}, name="pl_swot_upload")
     */
    public function uploadAction(Request $request)
    {
        $matrix = new Swot(null);
        $file = new File();
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $file->getFile();
            try {
                switch ($file->getClientOriginalExtension()) {
                    case 'json':
                        $x = $matrix->setJson(file_get_contents($file));
                        break;
                    case 'txt':
                        $x = 'txt';
                        break;
                    default:
                        throw new \LogicException('Undefined Extension');
                }

                dump($x);
                exit;

            } catch (\Exception $e) {
                exit('Exception');
            }

        }

        return $this->render('default/upload_file.html.twig', [
            'form' => $form->createView(),
        ]);
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