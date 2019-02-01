<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cicnavi\Ds\Arrays\FixedArray;

final class FixedArrayTest extends TestCase
{
	public function testCanCreateInstanceWithoutArguments()
	{
		$fixedArray = new FixedArray();
		$this->assertInstanceOf(FixedArray::class, $fixedArray);
		return $fixedArray;
	}

	public function testCanCreateInstanceWithZeroCapacity()
	{
		$fixedArray = new FixedArray(0);
		$this->assertInstanceOf(FixedArray::class, $fixedArray);
		return $fixedArray;
	}

	public function testCanCreateInstanceOfSpecificCapacity()
	{
		$fixedArray = new FixedArray(10);
		$this->assertInstanceOf(FixedArray::class, $fixedArray);
		return $fixedArray;
	}

	public function testCanNotCreateInstanceOfNegativeCapacity()
	{
		$this->expectException(InvalidArgumentException::class);

		(new FixedArray(-1));
	}

	/**
	 * @param FixedArray $fixedArray Array to check the size of.
	 *
	 * @depends testCanCreateInstanceOfSpecificCapacity
	 */
	public function testInitialSizeIsZero(FixedArray $fixedArray)
	{
		$this->assertEquals(0, $fixedArray->getSize());
	}

	/**
	 * @param FixedArray $fixedArray Array to check the size of.
	 *
	 * @depends clone testCanCreateInstanceOfSpecificCapacity
	 */
	public function testSizeIsOneAfterFirstSet(FixedArray $fixedArray)
	{
		$fixedArray->set(0, 'First');

		$this->assertEquals(1, $fixedArray->getSize());
	}

	/**
	 * @param FixedArray $fixedArray Array to check the size of.
	 *
	 * @depends clone testCanCreateInstanceOfSpecificCapacity
	 */
	public function testCantAddIfArrayIsFull(FixedArray $fixedArray)
	{
		$this->expectException(OutOfRangeException::class);

		$fixedArray->set(9, 'Last');

		$fixedArray->add('One more');
	}

	/**
	 * @param FixedArray $fixedArray Array to check the size of.
	 *
	 * @depends clone testCanCreateInstanceOfSpecificCapacity
	 */
	public function testCanInsertNewValue(FixedArray $fixedArray)
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
	 * @depends clone testCanCreateInstanceWithZeroCapacity
	 */
	public function testCanNotInsertNewValueOnArrayWithZeroCapacity(FixedArray $fixedArray)
	{
		$this->expectException(InvalidArgumentException::class);

		$value = 'First';
		$index = 0;

		$fixedArray->insert($index, $value);

	}

}