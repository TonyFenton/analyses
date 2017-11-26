<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Menu\Menu;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="en_homepage")
     * @Route("/pl", defaults={"_locale": "pl"}, name="pl_homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="en_contact")
     * @Route("/kontakt", defaults={"_locale": "pl"}, name="pl_contact")
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $email = $this->getUser() ? $this->getUser()->getEmail() : null;
        $contact->setFrom($email);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('mailer')->send(
                (new \Swift_Message($contact->getSubject()))
                    ->setFrom($contact::TO)// Can not be $contact->getFrom() because of 550 Incorrect sender header
                    ->setTo($contact::TO)
                    ->setBody("From: {$contact->getFrom()} </br>".$contact->getContent(), 'text/html')
            );

            $this->addFlash('success', 'contact.sent');
            $return = $this->redirectToRoute($request->get('_route'));
        } else {
            $return = $this->render('default/contact.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $return;
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
        $item = $menu->addItem('menu.default.swot', '');
        $item->addItem('menu.default.create', 'swot');
        $item->addItem('menu.default.upload', 'swot_upload');
        $item = $menu->addItem('menu.default.pest', '');
        $item->addItem('menu.default.create', 'pest');
        $item->addItem('menu.default.upload', 'pest_upload');

        return $this->render('default/_menu.html.twig', ['items' => $menu->getItems()]);
    }
}
