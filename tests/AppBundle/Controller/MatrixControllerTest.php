<?php

namespace Tests\AppBundle\Controller;

use Tests\FunctionalTestHelper;
use AppBundle\Controller\MatrixController;

class MatrixControllerTest extends FunctionalTestHelper
{
    public function testSwotAction()
    {
        $this->requestGet('/swot-analysis');
        $this->checkElementsQty(4, 'li.prototype-item');
        $this->checkElementsQty(9, '.matrix-cell');
        $this->checkElementsQty(8, '.head-list');
        $this->assertSame('Strengths', $this->crawler->filter('#swot_b2field')->attr('placeholder'));
    }

    public function testCreateFileResponse()
    {
        $this->checkCreateFileResponse('text/plain', 'Company_X_Y_Z.txt', ' Company X_Y_Z ', 'Some sth'.PHP_EOL);
        $this->checkCreateFileResponse('text/html', 'Zolcnua.html', 'Żółćńüä', 'Some Żółć');
        $this->checkCreateFileResponse('application/pdf', 'name07.pdf', '!$<?n"(a,;;me!#@07', '<?php echo \'asdf\' ?>');
        $this->checkCreateFileResponse('text/html', 'abababababababababababababababaababababababab.html',
            'abababababababababababababababaabababababababababababababababababa', '<p>ASDF</p>');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFileResponse_exception()
    {
        $this->checkCreateFileResponse('application/php', 'sth.php', 'sth', 'Lorem ipsum');
    }

    private function checkCreateFileResponse(string $type, string $expectedFileName, string $name, string $content)
    {
        $controller = new MatrixController();
        $class = new \ReflectionClass ($controller);
        $createFileResponse = $class->getMethod('createFileResponse');
        $createFileResponse->setAccessible(true);
        $response = $createFileResponse->invoke($controller, $type, $name, $content);

        $this->assertSame(
            "attachment; filename=\"$expectedFileName\"",
            $response->headers->get('Content-Disposition')
        );
        $this->assertSame($content, $response->getContent());
    }
}