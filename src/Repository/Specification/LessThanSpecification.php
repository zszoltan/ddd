<?php

namespace DDD\Repository\Specification;


class LessThanSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->lessThan($this->getProperty(),$this->getValue());
    }

}