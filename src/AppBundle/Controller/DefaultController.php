<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use  AppBundle\Form\SwotType;
use  AppBundle\Entity\SwotItem;
use  AppBundle\Entity\Swot;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $swotList = new Swot();

        $swotItem = new SwotItem();
        $swotItem->setName('test1');
        $swotList->getStrengths()->add($swotItem);

        $form = $this->createForm(swotType::class, $swotList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $swot = $form->getData();

            $strengths = $swot->getStrengths();

            while ($item = $strengths->next()) {
                echo $item->getName().'<br/>';
            }
           // exit('end');
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
