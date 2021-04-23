<?php

namespace Cicnavi\Ds\LinkedLists;

class Node
{
    /**
     * @var mixed $data
     */
    public $data;

    /**
     * @var Node|null $next
     */
    public $next;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }

    /**
     * @return mixed
     */
    public function readData()
    {
        return $this->data;
    }
}
