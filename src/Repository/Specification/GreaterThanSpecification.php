<?php

namespace DDD\Repository\Specification;


class GreaterThanSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->greaterThan($this->getProperty(),$this->getValue());
    }

}