<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use  AppBundle\Form\SwotType;
use  AppBundle\Entity\Item;
use  AppBundle\Entity\Swot;
use  AppBundle\Utils\MatrixView\Matrix;
use  AppBundle\Utils\MatrixView\Row;
use  AppBundle\Utils\MatrixView\Cell;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/{_locale}/", requirements={"_locale": "%app_locales%"}, name="locale_homepage")
     */
    public function indexAction(Request $request)
    {
        $header = 'some header';

        return $this->render('default/index.html.twig', [
            'header' => $header,
        ]);
    }

    /**
     * @Route("/swot", name="swot")
     * @Route("/{_locale}/swot", requirements={"_locale": "%app_locales%"}, name="locale_swot")
     */
    public function swotAction(Request $request)
    {
        $item = new Item();
        $item->setName('Hey, I\'m your item');
        $swot = new Swot();
        $swot->setName('test');
        $swot->setA2Field('test');
        $swot->getB2Items()->add($item);

        $form = $this->createForm(SwotType::class, $swot, ['translator' => $this->get('translator')]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $swot = $form->getData();

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
            'matrixview' => $this->createSwotView(),
        ]);
    }

    private function createSwotView()
    {
        $matrix = new Matrix();
        $matrix->addClass('swot-matrix');

        $aRow = new Row();
        $aRow->addClass('hidden-xs hidden-sm');
        $bRow = new Row();
        $cRow = new Row();
        $matrix->addRow($aRow)->addRow($bRow)->addRow($cRow);

        $a1Cell = new Cell();
        $a1Cell->setIsField(false)->setIsItems(false)->addClass('col-md-2');
        $a2Cell = new Cell();
        $a2Cell->setIsItems(false)->addClass('col-md-5');
        $a3Cell = new Cell();
        $a3Cell->setIsItems(false)->addClass('col-md-5');
        $b1Cell = new Cell();
        $b1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $b2Cell = new Cell();
        $b2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $b3Cell = new Cell();
        $b3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $c1Cell = new Cell();
        $c1Cell->setIsItems(false)->addClass('hidden-xs hidden-sm col-md-2');
        $c2Cell = new Cell();
        $c2Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $c3Cell = new Cell();
        $c3Cell->addClass('col-xs-12 col-sm-6 col-md-5');
        $aRow->addCell($a1Cell)->addCell($a2Cell)->addCell($a3Cell);
        $bRow->addCell($b1Cell)->addCell($b2Cell)->addCell($b3Cell);
        $cRow->addCell($c1Cell)->addCell($c2Cell)->addCell($c3Cell);

        return $matrix;
    }

}
