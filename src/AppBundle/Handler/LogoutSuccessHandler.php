<?php

namespace AppBundle\Handler;

use Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\RequestStack;

class LogoutSuccessHandler extends DefaultLogoutSuccessHandler
{
    public function __construct(HttpUtils $httpUtils, RequestStack $requestStack)
    {
        $targetUrl = $requestStack->getCurrentRequest()->getLocale().'_fos_user_security_login';
        parent::__construct($httpUtils, $targetUrl);
    }
}