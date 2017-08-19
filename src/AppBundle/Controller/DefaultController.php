<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Menu\Menu;
use AppBundle\Entity\Page\Page;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="en_homepage")
     * @Route("/pl", defaults={"_locale": "pl"}, name="pl_homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'page' => $this->getDoctrine()->getManager()->getRepository(Page::class)->findOneByRoute($request->get('_route')),
        ]);
    }

    public function langSwitchesAction(Request $request)
    {
        $params = array_merge(
            $request->query->all(), // $_GET params
            $request->get('_route_params')
        );
        unset($params['_locale']);
        $route = $request->get('_route');
        $userLocale = $request->getLocale();
        $baseRoute = preg_replace("/^{$userLocale}_/", '_', $route);
        $appLocales = explode('|', $this->getParameter('app_locales'));
        $uris = [];
        foreach ($appLocales as $appLocale) {
            try {
                $uris[$appLocale] = $this->generateUrl($appLocale.$baseRoute, $params);
            } catch (\Exception $e) {
                // when route for $appLocale doesn't exist
            }
        }

        return $this->render('default/_lang_switches.html.twig', ['uris' => $uris]);
    }

    public function menuAction(Request $request, string $route)
    {
        $menu = new Menu($this->get('router'), $route, $request->getLocale());
        $menu->addItem('menu.default.homepage', 'homepage');
        $menu->addItem('menu.default.swot', 'swot');
        $menu->addItem('menu.default.upload', 'upload');

        return $this->render('default/_menu.html.twig', ['items' => $menu->getItems()]);
    }
}