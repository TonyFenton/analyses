<?php

namespace Tests\AppBundle\Controller;

use Tests\FunctionalTestHelper;
use AppBundle\Controller\DefaultController;

class DefaultControllerTest extends FunctionalTestHelper
{
    public function testSwotAction()
    {
        $this->requestGet('/swot-analysis');
        $this->checkElementsQty(4, 'li.prototype-item');
        $this->checkElementsQty(9, '.cell');
        $this->checkElementsQty(8, '.head-list');
        $this->assertSame('Strengths', $this->crawler->filter('#swot_b2_field')->attr('placeholder'));
    }

    public function testCreateFileResponse()
    {
        $this->checkCreateFileResponse('Company_X_Y_Z.txt', ' Company X_Y_Z ', 'txt', 'Some sth'.PHP_EOL);
        $this->checkCreateFileResponse('Zolcnua.html', 'Żółćńüä', 'html', 'Some Żółć');
        $this->checkCreateFileResponse('name07.php', '!$<?n"(a,;;me!#@07', 'php', '<?php echo \'asdf\' ?>');
        $this->checkCreateFileResponse('abababababababababababababababaababababababab.html',
            'abababababababababababababababaabababababababababababababababababa', 'html', '<p>ASDF</p>');
    }

    private function checkCreateFileResponse(string $expectedFileName, string $name, string $extension, string $content)
    {
        $controller = new DefaultController();
        $class = new \ReflectionClass ($controller);
        $createFileResponse = $class->getMethod('createFileResponse');
        $createFileResponse->setAccessible(true);
        $response = $createFileResponse->invoke($controller, $name, $extension, $content);

        $this->assertSame("attachment; filename=\"$expectedFileName\"",
            $response->headers->get('Content-Disposition'));
        $this->assertSame($content, $response->getContent());
    }
}