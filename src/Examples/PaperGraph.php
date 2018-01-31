<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Graflow\Examples;

use Limen\Graflow\Contracts\BaseGraph;

/**
 * Class PaperGraph
 * @package Limen\Graflow\Examples
 */
class PaperGraph extends BaseGraph
{
    public function getNodeGraph()
    {
        return [
            'blank' => ['editing', 'canceled'],
            'editing' => ['draft', 'canceled'],
            'draft' => ['editing', 'published', 'canceled'],
            'published' => ['draft', 'printed', 'canceled'],
            'printed' => [],
            'canceled' => [],
        ];
    }
}