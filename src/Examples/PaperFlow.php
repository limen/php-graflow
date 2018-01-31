<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Nodeflow\Examples;

use Limen\Nodeflow\Contracts\BaseFlow;
use Limen\Nodeflow\Contracts\BaseGraph;

/**
 * Class PaperFlow
 * @package Limen\Nodeflow\Examples
 */
class PaperFlow extends BaseFlow
{
    /**
     * @var BaseGraph
     */
    protected $graph;

    public function __construct()
    {
        $this->graph = new PaperGraph();

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