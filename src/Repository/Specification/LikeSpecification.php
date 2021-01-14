<?php

namespace DDD\Repository\Specification;


class LikeSpecification extends PropertyValueSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        $provider->likeAfter($this->getProperty(),$this->getValue());
    }

}