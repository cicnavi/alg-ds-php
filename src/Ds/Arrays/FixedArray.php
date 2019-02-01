<?php
declare(strict_types = 1);

namespace Cicnavi\Ds\Arrays;

use SplFixedArray;

use InvalidArgumentException;
use OutOfRangeException;

class FixedArray 
{
    protected $fixedArray;
    protected $capacity;
    protected $size = 0;

	/**
	 * FixedArray constructor.
	 *
	 * @param int $capacity
	 */
	public function __construct(int $capacity = 1)
    {
    	if ($capacity < 0) {
    		throw new InvalidArgumentException("Invalid capacity.");
	    }

    	$this->capacity = $capacity;

        $this->fixedArray = new SplFixedArray($capacity);    
    }

	/**
	 * Set value at specific index.
	 *
	 * @param int $index
	 * @param mixed $value
	 */
    public function set(int $index, $value): void
    {
    	$this->validateIndex($index);

	    $this->resolveSize($index);

	    $this->fixedArray->offsetSet($index, $value);

    }

	/**
	 * Add value to the end of the array.
	 *
	 * @param $value
	 */
    public function add($value): void
    {
    	$this->validateSize();

		$this->fixedArray->offsetSet($this->size, $value);

		$this->size++;
    }

	/**
	 * Insert value to the specified index.
	 *
	 * @param int $index
	 * @param $value
	 */
	public function insert(int $index, $value): void
	{
		$this->validateIndex($index);
		$this->validateSize();

		if ($index >= $this->size) {
			$this->fixedArray->offsetSet($index, $value);
			$this->resolveSize($index);
		} else {
			for($i = $this->size; $i > $index; $i--) {
				$this->fixedArray->offsetSet($i, $this->fixedArray->offsetGet($i - 1));
			}

			$this->fixedArray->offsetSet($index, $value);

			$this->size++;
		}

	}

	/**
	 * @param int $index
	 *
	 * @return mixed $value
	 */
    public function get(int $index)
    {
		$this->validateIndex($index);

		return $this->fixedArray->offsetGet($index);
    }

	/**
	 * Get current array size.
	 *
	 * @return int
	 */
    public function getSize(): int
    {
    	return $this->size;
    }

	/**
	 * Get current array capacity.
	 *
	 * @return int
	 */
	public function getCapacity(): int
	{
		return $this->capacity;
	}

	/**
	 * @param int $index
	 *
	 * @throws InvalidArgumentException
	 */
    protected function validateIndex(int $index)
    {
	    // Index must be smaller than capacity and at least 0.
	    if ( $index >= $this->capacity || $index < 0 ) {
		    throw new InvalidArgumentException("Invalid index.");
	    }
    }

    protected function validateSize()
    {
	    if ($this->size >= $this->capacity) {
		    throw new OutOfRangeException("Array is already full.");
	    }
    }

    protected function resolveSize(int $index)
    {
	    // If current size is smaller than this index, indicate the new size.
	    if ( $this->size <= $index ) {
		    $this->size = $index + 1;
	    }
    }
}