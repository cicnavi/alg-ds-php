<?php
declare(strict_types = 1);

namespace Cicnavi\Ds\Arrays;

use SplFixedArray;

class FixedArray 
{
    protected $fixedArray;
    protected $capacity;
    protected $size;

	/**
	 * FixedArray constructor.
	 *
	 * @param int $capacity
	 */
	public function __construct(int $capacity = 0)
    {
        $this->fixedArray = new SplFixedArray($capacity);    
    }
}