<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Matrices\Matrix;

class UserController extends Controller
{
    /**
     * @Route("/my/analyses", name="en_analyses")
     * @Route("/pl/moje/analizy", defaults={"_locale": "pl"}, name="pl_analyses")
     */
    public function analysesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matrices = $em->getRepository(Matrix::class)->findAll();

        return $this->render('user/analyses.html.twig', ['matrices' => $matrices]);
    }
}