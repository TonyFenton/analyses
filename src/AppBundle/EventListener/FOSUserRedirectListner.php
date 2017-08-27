<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FOSUserRedirectListner implements EventSubscriberInterface
{
    private $router;
    private $locale;

    public function __construct(UrlGeneratorInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->locale = $requestStack->getCurrentRequest()->getLocale();
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'redirectToRegistrationConfirmed',
            FOSUserEvents::PROFILE_EDIT_SUCCESS => 'redirectToProfileShow',
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'redirectToProfileShow',
            FOSUserEvents::REGISTRATION_SUCCESS => 'redirectToProfileShow',
            FOSUserEvents::RESETTING_RESET_SUCCESS => 'redirectToProfileShow',
        );
    }

    public function redirectToRegistrationConfirmed(FormEvent $event)
    {
        $this->setRedirectResponse($event, 'fos_user_registration_confirmed');
    }

    public function redirectToProfileShow(FormEvent $event)
    {
        $this->setRedirectResponse($event, 'fos_user_profile_show');
    }

    private function setRedirectResponse(FormEvent $event, string $route)
    {
        $url = $this->router->generate($this->locale.'_'.$route);

        $event->setResponse(new RedirectResponse($url));
    }
}