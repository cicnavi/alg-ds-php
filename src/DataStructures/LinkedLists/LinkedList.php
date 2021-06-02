<?php

namespace Cicnavi\DataStructures\LinkedLists;

use SplDoublyLinkedList;
use InvalidArgumentException;
use OutOfRangeException;

class LinkedList
{
    private SplDoublyLinkedList $doubleLinkedList;

    public function __construct()
    {
        $this->doubleLinkedList = new SplDoublyLinkedList();
    }

    /**
     * Returns if is empty.
     * @return bool
     */
    public function isEmpty()
    {
        return $this->doubleLinkedList->isEmpty();
    }

    /**
     * Insert value to the top.
     *
     * @param mixed $data
     *
     * @return void
     */
    public function insertFirst($data): void
    {
        $node = new Node($data);
        if ($this->count() > 0) {
            $node->next = $this->doubleLinkedList->shift();
        }

        $this->doubleLinkedList->unshift($node);
    }

    /**
     * Insert value to the last.
     *
     * @param mixed $data
     *
     * @return void
     */
    public function insertLast($data): void
    {
        $node = new Node($data);
        $lastNode = $this->doubleLinkedList->top();
        $lastNode->next = $node;
        $this->doubleLinkedList->offsetSet($this->count() - 1, $lastNode);
        $this->doubleLinkedList->push($node);
    }

    /**
     * Insert value to the specified index
     *
     * @param int $index
     * @param mixed $data
     *
     * @return void
     */
    public function insertNode(int $index, $data): void
    {
        $this->validateIndex($index);
        $node = new Node($data);
        $size = $this->count();
        if ($index >= $size) {
            $this->doubleLinkedList->push($node);
        } else {
            $previousNode = $this->doubleLinkedList->offsetGet($index);
            $previousNode->next = $node;
            $nextNode = null;
            if (($index + 1) < $size) {
                $nextNode = $this->doubleLinkedList->offsetGet($index + 1);
                $node->next = $nextNode;
            }
            $this->doubleLinkedList->add($index, $node);
        }
    }

    /**
     * Delete last item
     *
     * @return void
     */
    public function deleteLastNode(): void
    {
        $this->doubleLinkedList->pop();
    }

    /**
     * Delete first item
     *
     * @return void
     */
    public function deleteFirstNode(): void
    {
        $this->doubleLinkedList->shift();
    }

    /**
     * Delete item from list at specified index.
     *
     * @param int $index
     *
     * @return void
     */
    public function deleteNode(int $index): void
    {
        $this->validateIndex($index);
        $previousNode = null;
        $nextNode = null;

        if (($index - 1) >= 0) {
            $previousNode = $this->doubleLinkedList->offsetGet($index - 1);
        }

        if (($index + 1) < $this->count()) {
            $nextNode = $this->doubleLinkedList->offsetGet($index + 1);
        }

        $this->doubleLinkedList->offsetUnset($index);

        if ($previousNode != null && $nextNode != null) {
            $previousNode->next = $nextNode;
            $this->doubleLinkedList->offsetSet($index - 1, $previousNode);
        }
    }

    /**
     * Get value at given index.
     *
     * @param int $index
     *
     * @return mixed $value
     */
    public function get(int $index)
    {
        $this->validateIndex($index);
        return $this->doubleLinkedList->offsetGet($index)->readData();
    }

    /**
     * Get current list size.
     *
     * @return int
     */
    public function count()
    {
        return $this->doubleLinkedList->count();
    }

    /**
     * Validate that index is in range.
     *
     * @param int $index
     *
     * @throws InvalidArgumentException
     *
     * @return void
     */
    protected function validateIndex(int $index): void
    {
        // Index must be smaller than capacity and at least 0.
        if ($index >= $this->doubleLinkedList->count() || $index < 0) {
            throw new InvalidArgumentException("Invalid index.");
        }
    }
}
