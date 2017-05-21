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

            $fileContent = 'ddddd'; // the generated file content
            $response = new Response($fileContent);

            $disposition = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                'foo.pdf'
            );

            $response->headers->set('Content-Disposition', $disposition);

            return $response;
        }

        return $this->render('default/swot.html.twig', [
            'form' => $form->createView(),
            'matrixview' => $swot->getView(),
        ]);
    }
}
