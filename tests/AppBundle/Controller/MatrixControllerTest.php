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
        $this->checkCreateFileResponse('Company_X_Y_Z.txt', 'text/plain', ' Company X_Y_Z ', 'Some sth'.PHP_EOL);
        $this->checkCreateFileResponse('Zolcnua.html', 'text/html', 'Żółćńüä', 'Some Żółć');
        $this->checkCreateFileResponse('name07.pdf', 'application/pdf', '!$<?n"(a,;;me!#@07', '<?php echo \'asdf\' ?>');
        $this->checkCreateFileResponse(
            'abababababababababababababababaababababababab.html',
            'text/html',
            'abababababababababababababababaabababababababababababababababababa',
            '<p>ASDF</p>'
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFileResponse_exception()
    {
        $this->checkCreateFileResponse('application/php', 'sth.php', 'sth', 'Lorem ipsum');
    }

    private function checkCreateFileResponse(string $expectedFileName, string $type, string $name, string $content)
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