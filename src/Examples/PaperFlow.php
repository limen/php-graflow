<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Graflow\Examples;

use Limen\Graflow\Contracts\BaseFlow;
use Limen\Graflow\Contracts\BaseGraph;

/**
 * Class PaperFlow
 * @package Limen\Graflow\Examples
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

    public function getGraph()
    {
        return $this->graph;
    }

    protected function doMoveStuff($position)
    {
        $currPosition = $this->getGraph()->getCurrentPosition();

        echo "Move from #$currPosition# to #$position# \n";

        return true;
    }
}