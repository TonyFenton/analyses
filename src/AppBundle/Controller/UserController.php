<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\Id;
use AppBundle\Form\DeleteType;

class UserController extends Controller
{
    /**
     * @Route("/my/analyses", name="en_analyses")
     * @Route("/pl/moje/analizy", defaults={"_locale": "pl"}, name="pl_analyses")
     */
    public function analysesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(Matrix::class)->getFindMatricesQuery($this->getUser());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            4/*limit per page*/
        );

        return $this->render('user/analyses.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/my/analyses/delete", name="en_analyses_delete")
     * @Route("/pl/moje/analizy/usun", name="pl_analyses_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, int $id = 0)
    {
        $idEntity = new Id();
        $idEntity->setId($id);
        $form = $this->createForm(DeleteType::class, $idEntity, [
            'action' => $this->generateUrl($request->getLocale().'_analyses_delete'),
            'translator' => $this->get('translator'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $id = $form->getData()->getId();
                $em = $this->getDoctrine()->getManager();
                $matrix = $em->getRepository(Matrix::class)->findOneBy(['id' => $id, 'user' => $this->getUser()]);
                if ($matrix) {
                    $em->remove($matrix);
                    $em->flush();
                    $this->addFlash('success', 'matrix.remove');
                } else {
                    $this->addFlash('warning', 'matrix.not_found');
                }
            }
            $return = $this->redirectToRoute($request->getLocale().'_analyses');
        } else {
            $return = $this->render('_form.html.twig', ['form' => $form->createView()]);
        }

        return $return;
    }

    /**
     * @Route("/{_locale}/redirect-login", name="redirect_login")
     */
    public function redirectLoginAction($_locale)
    {
        return $this->redirectToRoute($_locale.'_fos_user_security_login');
    }
}