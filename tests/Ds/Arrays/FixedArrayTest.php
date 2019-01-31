<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cicnavi\Ds\Arrays\FixedArray;

final class FixedArrayTest extends TestCase
{
	public function testCanCreateInstanceWithoutArguments()
	{
		$this->assertInstanceOf(FixedArray::class, new FixedArray());
	}

	public function testCanCreateInstanceOfSpecificCapacity()
	{
		$this->assertInstanceOf(FixedArray::class, new FixedArray(10));
	}
}