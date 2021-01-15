<?php

namespace DDD\Repository\Specification;


class LikeSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->like($this->getProperty(),$this->getValue());
    }

}