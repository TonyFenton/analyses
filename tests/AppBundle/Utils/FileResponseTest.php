<?php

namespace Tests\AppBundle\Utils;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use AppBundle\Utils\FileResponse;

class SwotTest extends TestCase
{
    /** @var FileResponse */
    private $fileResponse;

    /** @var Response */
    private $response;

    public function __construct()
    {
        parent::__construct();
        $this->fileResponse = new FileResponse();
    }

    public function testCreateAttachmentResponse()
    {
        $this->response = $this->fileResponse->createAttachmentResponse('text/plain', ' Company X_Y_Z ', 'Hello');
        $this->checkContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Company_X_Y_Z.txt');
        $this->checkContentType(null);
        $this->checkContent('Hello');
    }

    public function testCreateInlineResponse()
    {
        $this->response = $this->fileResponse->createInlineResponse('text/html', 'Żółćńüä', '<?php echo \'Hello\' ?>');
        $this->checkContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'Zolcnua.html');
        $this->checkContentType('text/html');
        $this->checkContent('<?php echo \'Hello\' ?>');
    }

    public function testCreateAttachmentResponseFromCanvas()
    {
        $this->response = $this->fileResponse->createAttachmentResponseFromCanvas(
            'application/pdf',
            '!$<?n"(a,;;me!#@07',
            'data:image/jpeg;base64,'
        );
        $this->checkContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'name07.pdf');
        $this->checkContentType(null);
        $this->checkContent('');
    }

    public function testCreateInlineResponseFromCanvas()
    {
        $this->response = $this->fileResponse->createInlineResponseFromCanvas(
            'text/html',
            'abababababababababababababababaabababababababababababababababababa',
            ','
        );
        $this->checkContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            'abababababababababababababababaababababababab.html'
        );
        $this->checkContentType('text/html');
        $this->checkContent('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateAttachmentResponse_exception()
    {
        $this->fileResponse->createAttachmentResponse('application/php', 'Company', '');
    }

    private function checkContentDisposition($expectedDisposition, $expectedFilename)
    {
        $this->assertSame(
            "$expectedDisposition; filename=\"$expectedFilename\"",
            $this->response->headers->get('Content-Disposition'),
            'Wrong Content-Disposition'
        );
    }

    /**
     * @param null|string $expectedType
     */
    private function checkContentType($expectedType)
    {
        $this->assertSame(
            $expectedType,
            $this->response->headers->get('Content-Type'),
            'Wrong Content-Type'
        );
    }

    private function checkContent(string $expectedContent)
    {
        $this->assertSame(
            $expectedContent,
            $this->response->getContent(),
            'Wrong content'
        );
    }
}
