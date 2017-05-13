<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/** This controllers methods are called directly via the render() function in views */
class ElementsController extends Controller
{
    public function langSwitchesAction($uri, Request $request)
    {
        $baseUrl = $request->getBaseUrl();
        $locale = $this->getParameter('locale');
        $userLocale = $request->getLocale();
        $appLocales = explode('|', $this->getParameter('app_locales'));
        array_unshift($appLocales, $locale);
        $route = preg_replace("@^/$userLocale@", '', str_replace($baseUrl, '', $uri));

        $uris = [];
        foreach ($appLocales as $appLocale) {
            if ($appLocale == $locale) {
                $prefix = '';
            } else {
                $prefix = '/'.$appLocale;
            }
            $uris[$appLocale] = $baseUrl.$prefix.$route;
        }

        return $this->render('default/lang_switches.html.twig', ['uris' => $uris]);
    }
}
