<?php

namespace Limen\Graflow\Contracts;

/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/29
 */
interface FlowWatcherInterface
{
    /**
     * return true the following watchers would be called, or the opposite.
     *
     * @param $oldPosition
     * @param $newPosition
     * @return bool
     */
    public function beforeMove($oldPosition, $newPosition);

    /**
     * return true the following watchers would be called, or the opposite.
     *
     * @param $oldPosition
     * @param $newPosition
     * @return mixed
     */
    public function afterMove($oldPosition, $newPosition);
}