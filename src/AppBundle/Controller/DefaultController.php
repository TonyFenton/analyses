<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use  AppBundle\Form\SwotType;
use AppBundle\Utils\Matrices\Swot;

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

    private function createFileResponse(string $name, string $extension, string $content): Response
    {
        $spaceless = preg_replace('/\s/ ', '_', trim($name));
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $spaceless);
        $fileName = preg_replace("/[^a-zA-Z0-9_-]/", '', substr($ascii, 0, 45)).'.'.$extension;

        $response = new Response($content);
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}