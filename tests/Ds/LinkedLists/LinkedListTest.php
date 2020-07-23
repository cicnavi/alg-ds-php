<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cicnavi\Ds\LinkedLists\LinkedList;

final class LinkedListTest extends TestCase
{
    public function testCanCreateInstanceWithoutArguments()
	{
		$linkedList = new LinkedList();
		$this->assertInstanceOf(LinkedList::class, $linkedList);
		return $linkedList;
    }
    
    public function testIsEmpty()
    {
        $linkedList = new LinkedList();
        $isEmpty = $linkedList->isEmpty();
        $this->assertTrue($isEmpty);
    }

    public function testInsert()
    {
        $linkedList = new LinkedList();
        $linkedList->insertFirst(1);
        $isEmpty = $linkedList->isEmpty();
        $this->assertFalse($isEmpty);
        $linkedList->insertFirst(2);
        $firstNode = $linkedList->get(0);
        $this->assertEquals($firstNode, 2);
        $linkedList->insertLast(3);
        $lastNode = $linkedList->get($linkedList->count() - 1);
        $this->assertEquals($lastNode, 3);
        $linkedList->insertNode(1, 5);
        $indexNode = $linkedList->get(1);
        $this->assertEquals($indexNode, 5);
    }

    public function testDelete()
    {
        $linkedList = new LinkedList();
        $linkedList->insertFirst(1);
        $linkedList->deleteNode(0);
        $isEmpty = $linkedList->isEmpty();
        $this->assertTrue($isEmpty);
    }


    public function testCount()
    {
        $linkedList = new LinkedList();
        $linkedList->insertFirst(1);
        $linkedList->insertLast(1);
        $linkedList->insertLast(1);
        $linkedList->insertLast(1);
        $linkedList->insertLast(1);
        $linkedList->insertLast(1);
        $count = $linkedList->count();
        $this->assertGreaterThan(0, $count);
    }

    public function testCanNotInsertNewValueOnListWithWrongIndex()
    {
        $this->expectException(InvalidArgumentException::class);
        $linkedList = new LinkedList();
        $value = 'First';
        $index = 10;

        $linkedList->insertNode($index, $value);

    }
    
}