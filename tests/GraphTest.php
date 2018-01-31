<?php

use PHPUnit\Framework\TestCase;
use Limen\Nodeflow\Examples\PaperGraph;

class GraphTest extends TestCase
{
    public function testMove()
    {
        $graph = new PaperGraph();
        $head = $graph->getHeadNode();

        $this->assertEquals('blank', $head);

        $graph->setCurrentPosition('blank');

        $can = $graph->canMoveTo('editing');
        $this->assertTrue($can);

        $graph->moveTo('editing');
        $this->assertEquals($graph->getCurrentPosition(), 'editing');

        $can = $graph->canMoveTo('printed');
        $this->assertFalse($can);

        $graph->moveTo('draft');
        $this->assertEquals($graph->getCurrentPosition(), 'draft');

        $can = $graph->canMoveTo('editing');
        $this->assertTrue($can);

        $graph->moveTo('published');
        $this->assertEquals($graph->getCurrentPosition(), 'published');

        $graph->moveTo('printed');
        $this->assertEquals($graph->getCurrentPosition(), 'printed');

        $moved = $graph->moveTo('canceled');
        $this->assertFalse($moved);

        $bool = $graph->isAtEnd();
        $this->assertTrue($bool);
    }
}