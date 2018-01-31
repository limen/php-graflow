<?php

namespace Limen\Graflow\Contracts;

/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/29
 */
abstract class BaseFlow
{
    /**
     * @var FlowWatcherInterface[]
     */
    protected $watchers = [];

    /**
     * @return BaseGraph
     */
    abstract public function getGraph();

    /**
     * Do your business here
     *
     * @param $position
     * @return bool True when succeed or false
     */
    abstract protected function doMoveStuff($position);

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
        return $this->getGraph()->getCurrentPosition();
    }

    public function moveTo($position)
    {
        $currPosition = $this->getCurrentPosition();

        $this->beforeMove($currPosition, $position);

        if ($this->doMoveStuff($position)) {
            $this->getGraph()->setCurrentPosition($position);

            $this->afterMove($currPosition, $position);
        }
    }

    /**
     * @param $position
     * @return bool
     */
    public function canMoveTo($position)
    {
        return $this->getGraph()->canMoveTo($position);
    }

    /**
     * @return bool
     */
    public function isAtStart()
    {
        return $this->getGraph()->isAtStart();
    }

    /**
     * @return bool
     */
    public function isAtEnd()
    {
        return $this->getGraph()->isAtEnd();
    }

    /**
     * @param $position
     * @return bool
     */
    public function isAtPosition($position)
    {
        return $this->getGraph()->isAtPosition($position);
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