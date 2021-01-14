<?php

namespace DDD\Repository\Specification;


class EqualSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->equal($this->getProperty(),$this->getValue());
    }

}