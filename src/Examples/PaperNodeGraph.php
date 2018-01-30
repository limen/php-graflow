<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Nodeflow\Examples;

use Limen\Nodeflow\Contracts\BaseNodeGraph;

/**
 * Class PaperNodeGraph
 * @package Limen\Nodeflow\Examples
 */
class PaperNodeGraph extends BaseNodeGraph
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