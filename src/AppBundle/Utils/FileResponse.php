<?php

namespace AppBundle\Utils;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FileResponse
{
    public function createAttachmentResponse(string $type, string $name, string $content): Response
    {
        return $this->createResponse(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $type,
            $name,
            $content
        );
    }

    public function createInlineResponse(string $type, string $name, string $content): Response
    {
        return $this->createResponse(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $type,
            $name,
            $content
        );
    }

    public function createAttachmentResponseFromCanvas(string $type, string $name, string $canvas): Response
    {
        return $this->createResponse(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $type,
            $name,
            $this->decodeCanvas($canvas)
        );
    }

    public function createInlineResponseFromCanvas(string $type, string $name, string $canvas): Response
    {
        return $this->createResponse(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $type,
            $name,
            $this->decodeCanvas($canvas)
        );
    }

    private function createResponse(string $dispositionType, string $type, string $name, string $content): Response
    {
        $filename = $this->createFilename($type, $name);
        $response = new Response($content);
        $disposition = $response->headers->makeDisposition($dispositionType, $filename);
        $response->headers->set('Content-Disposition', $disposition);
        if (ResponseHeaderBag::DISPOSITION_INLINE === $dispositionType) {
            $response->headers->set('Content-Type', $type);
        }

        return $response;
    }

    private function createFilename(string $type, string $name): string
    {
        $spaceless = preg_replace('/\s/ ', '_', trim($name));
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $spaceless);

        return preg_replace("/[^a-zA-Z0-9_-]/", '', substr($ascii, 0, 45)).'.'.$this->getExtension($type);
    }

    private function decodeCanvas(string $canvas): string
    {
        return base64_decode(explode(',', $canvas)[1]);
    }

    private function getExtension(string $contentType): string
    {
        switch ($contentType) {
            case 'text/plain':
                $extension = 'txt';
                break;
            case 'application/json':
                $extension = 'json';
                break;
            case 'image/jpeg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'text/html':
                $extension = 'html';
                break;
            case 'application/pdf':
                $extension = 'pdf';
                break;
            default:
                throw new \InvalidArgumentException('Wrong contentType argument, got "'.$contentType.'"');
        }

        return $extension;
    }
}
