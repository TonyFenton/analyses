<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/** This controllers methods are called directly via the render() function in views */
class ElementsController extends Controller
{
    public function langSwitchesAction(string $route, array $params, Request $request)
    {
        unset($params['_locale']);
        $userLocale = $request->getLocale();
        $baseRoute = preg_replace("/^{$userLocale}_/", '_', $route);
        $locale = $this->getParameter('locale');
        $appLocales = explode('|', $this->getParameter('app_locales'));
        array_unshift($appLocales, $locale);
        $uris = [];
        foreach ($appLocales as $appLocale) {
            try {
                $uris[$appLocale] = $this->generateUrl($appLocale.$baseRoute, $params);
            } catch (\Exception $e) {
                // when route for $appLocale doesn't exist
            }
        }

        return $this->render('default/lang_switches.html.twig', ['uris' => $uris]);
    }
}
