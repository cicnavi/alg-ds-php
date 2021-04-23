<?php

declare(strict_types=1);

namespace Cicnavi\Tests\LinkedLists;

use PHPUnit\Framework\TestCase;
use Cicnavi\Ds\Arrays\FixedArray;

final class FixedArrayTest extends TestCase
{
    public function testCanCreateInstanceWithoutArguments(): FixedArray
    {
        $fixedArray = new FixedArray();
        $this->assertInstanceOf(FixedArray::class, $fixedArray);
        return $fixedArray;
    }

    public function testCanCreateInstanceWithZeroCapacity(): FixedArray
    {
        $fixedArray = new FixedArray(0);
        $this->assertInstanceOf(FixedArray::class, $fixedArray);
        return $fixedArray;
    }

    public function testCanCreateInstanceOfSpecificCapacity(): FixedArray
    {
        $fixedArray = new FixedArray(10);
        $this->assertInstanceOf(FixedArray::class, $fixedArray);
        return $fixedArray;
    }

    public function testCanNotCreateInstanceOfNegativeCapacity(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new FixedArray(-1));
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testInitialSizeIsZero(FixedArray $fixedArray): void
    {
        $this->assertEquals(0, $fixedArray->getSize());
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testSizeIsOneAfterFirstSet(FixedArray $fixedArray): void
    {
        $fixedArray->set(0, 'First');

        $this->assertEquals(1, $fixedArray->getSize());
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testCantAddIfArrayIsFull(FixedArray $fixedArray): void
    {
        $this->expectException(\OutOfRangeException::class);

        $fixedArray->set(9, 'Last');

        $fixedArray->add('One more');
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testCanInsertNewValue(FixedArray $fixedArray): void
    {
        $value = 'Third';
        $index = 2;

        $fixedArray->insert($index, $value);

        $this->assertEquals(3, $fixedArray->getSize());
        $this->assertEquals($value, $fixedArray->get($index));
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testContainsAddedValue(FixedArray $fixedArray): void
    {
        $fixedArray->add(1);

        $this->assertTrue($fixedArray->contains(1));
        $this->assertFalse($fixedArray->contains(2));
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testItemCanBeDeleted(FixedArray $fixedArray): void
    {
        $fixedArray->add(1);
        $fixedArray->add(2);
        $fixedArray->add(3);

        $fixedArray->delete(0);

        $this->assertTrue($fixedArray->contains(2));
        $this->assertEquals(2, $fixedArray->get(0));
        $this->assertEquals(2, $fixedArray->getSize());
        $this->assertTrue($fixedArray->contains(3));
        $this->assertFalse($fixedArray->contains(1));
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceOfSpecificCapacity
     *
     * @return void
     */
    public function testSizeIsResolvedWhenIndexIsBiggerThanSize(FixedArray $fixedArray): void
    {
        $fixedArray->add(1);
        $fixedArray->insert(3, 2);

        $this->assertEquals(4, $fixedArray->getSize());
    }

    /**
     * @param FixedArray $fixedArray Array to check the size of.
     *
     * @depends clone testCanCreateInstanceWithZeroCapacity
     *
     * @return void
     */
    public function testCanNotInsertNewValueOnArrayWithZeroCapacity(FixedArray $fixedArray): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $value = 'First';
        $index = 0;

        $fixedArray->insert($index, $value);
    }
}
