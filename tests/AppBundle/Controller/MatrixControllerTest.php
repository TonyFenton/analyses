<?php

namespace Tests\AppBundle\Controller;

use Tests\FunctionalTestHelper;

class MatrixControllerTest extends FunctionalTestHelper
{
    public function testSwotAction()
    {
        $this->requestGet('/swot-analysis');
        $this->checkElementsQty(4, 'li.prototype-item');
        $this->checkElementsQty(9, '.matrix-cell');
        $this->checkElementsQty(8, '.matrix-head-list');
        $this->assertSame('Strengths', $this->crawler->filter('#swot_b2field')->attr('placeholder'));
    }
}
