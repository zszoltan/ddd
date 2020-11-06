<?php

namespace DDD\Collection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Enumerable;
use JsonSerializable;
use Traversable;
use ArrayAccess;
use IteratorAggregate;
use ArrayIterator;
use Exception;

class CollectionArrayIterator extends ArrayIterator {

    private $_ref_array;
    private $_num = 0;

    public function __construct(array &$array, $flags = 0) {
        parent::__construct($array, $flags);
        $this->_ref_array = &$array;
    }

    public function key() {
        $keys = array_keys($this->_ref_array);
        return $keys[$this->_num - ($this->count() - count($this->_ref_array))];
    }

    public function next() {
        $this->_num++;
        return parent::next();
    }
}

abstract class Collection implements IteratorAggregate, ArrayAccess {

    protected $items;

    public function __construct($items = []) { 
        $this->items = $this->getArrayableItems($items);
    }

            /**
     * Results array of items from Collection or Arrayable.
     *
     * @param  mixed  $items
     * @return array
     */
    protected function getArrayableItems($items)
    {
        if (is_array($items)) {
            return $items;
        } elseif ($items instanceof Enumerable) {
            return $items->all();
        } elseif ($items instanceof Arrayable) {
            return $items->toArray();
        } elseif ($items instanceof Jsonable) {
            return json_decode($items->toJson(), true);
        } elseif ($items instanceof JsonSerializable) {
            return (array) $items->jsonSerialize();
        } elseif ($items instanceof Traversable) {
            return iterator_to_array($items);
        }

        return (array) $items;
    }


    public function getIterator() {
        return new CollectionArrayIterator($this->items);
    }

    /**
     * Get element count
     * @return int
     */
    public function count() {
        return count($this->items);
    }

    /**
     * Clear all elements
     */
    public function clear() {
        $this->items = array();
    }

    /**
     * Append new element to items
     * @param $item
     * @return int
     */
    public function add($item) {
        array_push($this->items, $item);
        return $this->count() - 1;
    }

    public function get($idx) {
        if (isset($this->items[$idx])) {
            return $this->items[$idx];
        }
        throw new Exception('Index out of bounds.');
    }


    public function insert($index, $item) {
        array_splice($this->items, $index, 0, array($item));
    }

    public function removeAt($index) {
        array_splice($this->items, $index, 1);
    }


    public function sortBy(callable $callback)
    {
        return usort($this->items, $callback);
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

}
