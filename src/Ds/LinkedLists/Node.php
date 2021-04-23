<?php

namespace Cicnavi\Ds\LinkedLists;

class Node
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }

    public function readData()
    {
        return $this->data;
    }
}
