<?php

declare(strict_types=1);

namespace Cicnavi\Tests\LinkedLists;

use PHPUnit\Framework\TestCase;
use Cicnavi\Ds\LinkedLists\Node;

final class NodeTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $node = new Node('test phrase');
        $this->assertInstanceOf(Node::class, $node);
    }

    public function testNextNodeNotNull()
    {
        $node = new Node('test phrase');
        $node->next = new Node('test phrase 2');
        $this->assertInstanceOf(Node::class, $node->next);
    }

    public function testReadData()
    {
        $node = new Node('test phrase');
        $this->assertEquals($node->readData(), 'test phrase');
    }
}
