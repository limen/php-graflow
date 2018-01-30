<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Nodeflow\Examples;

use Limen\Nodeflow\Contracts\BaseNodeFlow;
use Limen\Nodeflow\Contracts\BaseNodeGraph;

/**
 * Class PaperFlow
 * @package Limen\Nodeflow\Examples
 */
class PaperFlow extends BaseNodeFlow
{
    /**
     * @var BaseNodeGraph
     */
    protected $graph;

    public function __construct()
    {
        $this->graph = new PaperNodeGraph();

        $this->graph->setCurrentPosition('draft');
    }

    public function getNodeGraph()
    {
        return $this->graph;
    }

    protected function doMoveStuff($position)
    {
        $currPosition = $this->getNodeGraph()->getCurrentPosition();

        echo "Move from #$currPosition# to #$position# \n";

        return true;
    }
}