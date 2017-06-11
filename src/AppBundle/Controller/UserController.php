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
        $query = $em->getRepository(Matrix::class)->getFindMatricesQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            4/*limit per page*/
        );

        return $this->render('user/analyses.html.twig', ['pagination' => $pagination]);
    }
}