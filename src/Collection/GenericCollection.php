<?php

namespace DDD\Collection;

use ReflectionClass;

class GenericCollection extends Collection
{
    protected $class;
    public function __construct($class, $items = [])
    {

        if(!class_exists($class))
        {
            throw new \UnexpectedValueException(sprintf(
                "Invalid value passed to %s",
                get_class($this)
            ));
        }
        $this->class = new ReflectionClass($class);

        $items = $this->getArrayableItems($items);

        $this->validateValues($items);

       parent::__construct($items);
    }



    public function add($item) {
        if (!$this->_class->isInstance($item))
            throw new ECollectionException("Invalid class of item add to GenericCollection", -2);
        return parent::add($item);
    }

        /**
     * @param mixed $values [optional]
     *
     * @return $this
     */
    final public function addRange(...$items)
    {
        $this->validateValues($items);

        foreach ($items as $item) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function insert($index, $item) {
        $this->validateValue($item);
        return parent::insert($index,$item);
    }




    protected function createItem() {
        return $this->_class->newInstance();
    }

    public function getClassName() {
        return $this->_class->getName();
    }
    public function getClass() {
        return $this->_class;
    }
    private function validateValues(array $items)
    {
        foreach ($items as $item) {
            $this->validateValue($item);
        }
    }
    private function validateValue($item)
    {
        if (!($item instanceof $this->class)) {
            throw new \UnexpectedValueException(sprintf(
                "Invalid value passed to %s",
                get_class($this)
            ));
        }
    }



}
