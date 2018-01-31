<?php
/**
 * Author:      limengxiang
 * Email:       limengxiang@kuainiugroup.com
 * Created at:  2018/1/30
 */

namespace Limen\Graflow\Contracts;

/**
 * Class BaseGraph
 * @package Limen\Graflow\Contracts
 */
abstract class BaseGraph
{
    /**
     * @var string
     */
    protected $currentPosition;

    /**
     * Key is node name, value should be array contains its adjacent nodes.
     * If have no adjacent node, the value should be empty array.
     * The first key must be the head node.
     * [
     *      A => [B,C],
     *      B => [D,E],
     *      C => [A],
     * ]
     * @return array
     */
    abstract public function getNodeGraph();

    /**
     * @return string
     */
    public function getHeadNode()
    {
        $graph = $this->getNodeGraph();

        foreach ($graph as $node => $adjacent) {
            return $node;
        }

        return null;
    }

    /**
     * @param $position
     * @return $this
     */
    public function setCurrentPosition($position)
    {
        $this->currentPosition = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    public function moveTo($position)
    {
        if (!$this->canMoveTo($position)) {
            return false;
        }

        $this->setCurrentPosition($position);

        return true;
    }

    /**
     * @param $position
     * @return bool
     */
    public function canMoveTo($position)
    {
        $currentPosition = $this->getCurrentPosition();

        $adjacent = $this->getAdjacentNodes($currentPosition);

        return $adjacent && in_array($position, $adjacent);
    }

    /**
     * @return bool
     */
    public function isAtEnd()
    {
        return !$this->getAdjacentNodes($this->getCurrentPosition());
    }

    /**
     * @return bool
     */
    public function isAtStart()
    {
        return $this->getCurrentPosition() === $this->getHeadNode();
    }

    /**
     * @param string $position
     * @return bool
     */
    public function isAtPosition($position)
    {
        return $this->getCurrentPosition() === $position;
    }

    /**
     * @param $node
     * @return array|mixed
     */
    protected function getAdjacentNodes($node)
    {
        $graph = $this->getNodeGraph();

        return $graph && isset($graph[$node]) ? $graph[$node] : [];
    }
}