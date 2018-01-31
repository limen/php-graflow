<?php

use PHPUnit\Framework\TestCase;
use Limen\Graflow\Examples\PaperFlow;

class PaperFlowTest extends TestCase
{
    public function testMove()
    {
        $flow = new PaperFlow();

        $this->assertEquals($flow->getCurrentPosition(), 'draft');

        $can = $flow->canMoveTo('printed');
        $this->assertFalse($can);

        $can = $flow->canMoveTo('blank');
        $this->assertFalse($can);

        $can = $flow->canMoveTo('canceled');
        $this->assertTrue($can);

        $flow->moveTo('published');
        $this->assertEquals($flow->getCurrentPosition(), 'published');

        $flow->moveTo('draft');
        $this->assertEquals($flow->getCurrentPosition(), 'draft');

        $flow->moveTo('published');
        $this->assertEquals($flow->getCurrentPosition(), 'published');

        $flow->moveTo('printed');
        $this->assertEquals($flow->getCurrentPosition(), 'printed');

        $bool = $flow->isAtStart();
        $this->assertFalse($bool);

        $bool = $flow->isAtEnd();
        $this->assertTrue($bool);

        $bool = $flow->isAtPosition('printed');
        $this->assertTrue($bool);
    }
}