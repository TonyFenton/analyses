<?php

namespace Tests\AppBundle\Controller;

use Tests\FunctionalTestHelper;

class DefaultControllerTest extends FunctionalTestHelper
{
    public function testSwotAction()
    {
        $this->requestGet('/swot-analysis');
        $this->checkElementsQty(4, 'li.prototype-item');
        $this->checkElementsQty(9, '.cell');
        $this->checkElementsQty(8, '.head-list');
        $this->assertSame('Strengths', $this->crawler->filter('#swot_b2_field')->attr('value'));

    }
}
