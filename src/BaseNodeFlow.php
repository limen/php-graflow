<?php

namespace Limen\Nodeflow;

use Limen\Nodeflow\Contracts\FlowWatcherInterface;

/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/29
 */
abstract class BaseNodeFlow
{
    /**
     * @var FlowWatcherInterface[]
     */
    protected $watchers = [];

    /**
     *
     * node1 is the head node, it has two child nodes, node2 and node3
     * node6 are the tail node
     *
     * @return array
     */
    abstract protected function getNodeGraph();

    abstract function doGoForwardStuff($position);

    abstract function doGoBackwardStuff($position);

    /**
     * @param FlowWatcherInterface $watcher
     * @return $this
     */
    public function addWatcher(FlowWatcherInterface $watcher)
    {
        $this->watchers[get_class($watcher)] = $watcher;

        return $this;
    }

    /**
     * @param string|FlowWatcherInterface $watcher
     * @return $this
     */
    public function removeWatcher($watcher)
    {
        if ($watcher instanceof FlowWatcherInterface) {
            unset($this->watchers[get_class($watcher)]);
        } else {
            unset($this->watchers[$watcher]);
        }

        return $this;
    }

    /**
     * @param $class
     * @return FlowWatcherInterface|null
     */
    public function getWatcher($class)
    {
        return isset($this->watchers[$class]) ? $this->watchers[$class] : null;
    }

    /**
     * @return FlowWatcherInterface[]
     */
    public function dumpWatchers()
    {
        $watchers = $this->watchers;
        $this->watchers = [];

        return $watchers;
    }

    /**
     * @return string
     */
    public function getCurrentPosition()
    {

    }

    public function goForward($position)
    {
        $currPosition = $this->getCurrentPosition();

        $this->beforeMove($currPosition, $position);

        $this->doGoForwardStuff($position);

        $this->afterMove($currPosition, $position);
    }

    public function goBackward($position)
    {
        $currPosition = $this->getCurrentPosition();

        $this->beforeMove($currPosition, $position);

        $this->doGoBackwardStuff($position);

        $this->afterMove($currPosition, $position);
    }

    /**
     * @param $position
     * @return bool
     */
    public function canGoForwardTo($position)
    {

    }

    /**
     * @param $position
     * @return bool
     */
    public function canGoBackwardTo($position)
    {

    }

    /**
     * @return bool
     */
    public function isAtEnd()
    {

    }

    /**
     * @return bool
     */
    public function isAtStart()
    {

    }

    /**
     * @param $position
     * @return bool
     */
    public function isAtPosition($position)
    {

    }

    /**
     * Notice the watchers before move
     *
     * @param $oldPosition
     * @param $newPosition
     */
    protected function beforeMove($oldPosition, $newPosition)
    {
        foreach ($this->watchers as $name => $object) {
            if (!$object->beforeMove($oldPosition, $newPosition)) {
                break;
            }
        }
    }

    /**
     * Notice the watchers after move
     *
     * @param $oldPosition
     * @param $newPosition
     */
    protected function afterMove($oldPosition, $newPosition)
    {
        foreach ($this->watchers as $name => $object) {
            if (!$object->afterMove($oldPosition, $newPosition)) {
                break;
            }
        }
    }
}