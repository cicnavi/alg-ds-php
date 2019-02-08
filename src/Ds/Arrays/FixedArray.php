<?php
declare(strict_types = 1);

namespace Cicnavi\Ds\Arrays;

use SplFixedArray;

use InvalidArgumentException;
use OutOfRangeException;

class FixedArray 
{
    /**
     * @var SplFixedArray Array instance which will hold data.
     */
    protected $array;
    /**
     * @var int Total number of available slots for values in array.
     */
    protected $capacity;
    /**
     * @var int Number of occupied slots in array.
     */
    protected $size = 0;

	/**
	 * FixedArray constructor.
	 *
	 * @param int $capacity Total number of available slots for values in array.
	 */
	public function __construct(int $capacity = 1)
    {
        // Capacity must be positive and less than max int.
    	if ($capacity < 0 || $capacity > PHP_INT_MAX) {
    		throw new InvalidArgumentException("Invalid capacity.");
	    }

        // Keep note of initial capacity.
    	$this->capacity = $capacity;

    	// Create array instance.
        $this->array = new SplFixedArray($capacity);
    }

	/**
	 * Set value at specific index.
	 *
	 * @param int $index
	 * @param mixed $value
	 */
    public function set(int $index, $value): void
    {
        // Index must be valid.
    	$this->validateIndex($index);

    	// In case the index is larger than current size, resolve new size.
	    $this->resolveSize($index);

	    // Store value to specified index.
	    $this->array->offsetSet($index, $value);

    }

	/**
	 * Add value to the end of the array.
	 *
	 * @param mixed $value
	 */
    public function add($value): void
    {
        // We can only add new values if array is not full, so check this first.
    	$this->validateSize();

    	// Store new value at the end of the array.
		$this->array->offsetSet($this->size, $value);

		// Note the new size.
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
	    // Index must be valid.
		$this->validateIndex($index);
		// We can only insert new values if array is not already full.
		$this->validateSize();

		// In case the new index is
		if ($index >= $this->size) {
			$this->array->offsetSet($index, $value);
			$this->resolveSize($index);
		} else {
			for($i = $this->size; $i > $index; $i--) {
				$this->array->offsetSet($i, $this->array->offsetGet( $i - 1));
			}

			$this->array->offsetSet($index, $value);

			$this->size++;
		}

	}

    /**
     * Delete item from array at specified index.
     *
     * @param int $index
     */
	public function delete(int $index): void
    {
        // Index should be in valid range.
	    $this->validateIndex($index);

        // If index is bigger than current size, we don't have anything to delete.
	    if ($index >= $this->size) {
	        return;
        }

	    // Copy down existing data.
        for($i = $index; $i < $this->size - 1; $i++) {
            $this->array->offsetSet($i, $this->array->offsetGet( $i + 1));
        }

        // Unset last value.
        $this->array->offsetUnset( $this->size - 1);

        // Decrease size.
        $this->size--;
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
        // Index must be valid.
		$this->validateIndex($index);

		// Return value.
		return $this->array->offsetGet($index);
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
     * Check if array contains given value
     *
     * @param mixed $value
     *
     * @return bool
     */
	public function contains($value): bool
    {
        // Iterate through all values and return true if it is the same as given value.
        for($i = 0; $i < $this->size; $i++) {
            if ( $this->array[$i] == $value) {
                return true;
            }
        }

        // Value does not exist in array.
        return false;
    }

	/**
     * Validate that index is in range.
     *
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

    /**
     * Ensure that size meets capacity.
     */
    protected function validateSize()
    {
	    if ($this->size >= $this->capacity) {
		    throw new OutOfRangeException("Array is already full.");
	    }
    }

    /**
     * Resolve size when inserting value at index which is bigger than current size.
     *
     * @param int $index
     */
    protected function resolveSize(int $index)
    {
	    // If current size is smaller than this index, indicate the new size.
	    if ( $this->size <= $index ) {
		    $this->size = $index + 1;
	    }
    }
}