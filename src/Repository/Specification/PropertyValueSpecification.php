<?php

namespace DDD\Repository\Specification;

abstract class PropertyValueSpecification implements ISpecification
{
    private $_property;
    private $_value;
    public function __construct($property,$value)
    {
        $this->_property = $property;
        $this->_value = $value;
    }
    protected function getProperty()
    {
        return $this->_property;
    }
    protected function getValue()
    {
        return $this->_value;
    }

    public abstract function IsSatisfiedBy(ISpecificationProvider $provider);
     
}