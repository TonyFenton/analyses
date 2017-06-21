<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function langSwitchesAction(string $route, array $params, Request $request)
    {
        unset($params['_locale']);
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
}
