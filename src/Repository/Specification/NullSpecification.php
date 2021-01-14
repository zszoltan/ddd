<?php

namespace DDD\Repository\Specification;

use DDD\Repository\Specification\ISpecification;

class NullSpecification implements ISpecification
{
    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        return true;
    }
}