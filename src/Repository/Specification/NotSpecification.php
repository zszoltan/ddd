<?php

namespace DDD\Repository\Specification;

class NotSpecification extends CompositeSpecification  
{
    protected $specification;

    public function __construct(ISpecification $specification)  {
        $this->specification = $specification;
    }

    public function IsSatisfiedBy($object):bool  {
        return !$this->specification->IsSatisfiedBy($object);
    }
}