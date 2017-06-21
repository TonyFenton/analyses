<?php

namespace AppBundle\Entity\Matrix\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class FileForm
{
    /**
     * @Assert\NotBlank()
     * @Assert\File(
     *     mimeTypes = { "text/plain" }, mimeTypesMessage="error.wrong_mime_type",
     *     maxSize = "100k", maxSizeMessage="error.too_large_file",
     * )
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