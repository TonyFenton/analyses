<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\SwotItem;

class Swot
{
    // private $title;

    private $strengths;
    private $weaknesses;


    public function __construct()
    {
        $this->strengths = new ArrayCollection();
        $this->weaknesses = new ArrayCollection();
    }

    public function getStrengths(): ArrayCollection
    {
        return $this->strengths;
    }

    public function getWeaknesses(): ArrayCollection
    {
        return $this->weaknesses;
    }
}