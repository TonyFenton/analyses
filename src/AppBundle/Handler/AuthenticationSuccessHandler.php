<?php

namespace AppBundle\Handler;

use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    protected function determineTargetUrl(Request $request)
    {
        if ($this->options['default_target_path'] == '/') {
            $this->options['default_target_path'] = $request->getLocale().'_analyses';
        }

        return parent::determineTargetUrl($request);
    }
}