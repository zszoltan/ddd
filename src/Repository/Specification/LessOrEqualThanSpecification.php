<?php

namespace DDD\Repository\Specification;


class LessOrEqualThanSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->lessOrEqualThan($this->getProperty(),$this->getValue());
    }

}