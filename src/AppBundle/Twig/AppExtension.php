<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('cut', array($this, 'cutFilter')),
        );
    }

    public function cutFilter(string $text, int $maxLength): string
    {
        if (mb_strlen($text) > $maxLength) {
            $text = rtrim(
                    mb_substr($text, 0, $maxLength - 3)
                ).'...';
        }

        return $text;
    }
}