<?php

namespace AppBundle\Entity\Matrices;

use Symfony\Component\Validator\Constraints as Assert;

class File
{
    /**
     * @Assert\NotBlank()
     * @Assert\File(mimeTypes={ "text/plain" }, maxSize = "100k")
     */
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}