<?php

namespace DDD\Repository\Specification;


class GreaterOrEqualThanSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->greaterOrEqualThan($this->getProperty(),$this->getValue());
    }

}