<?php

namespace DDD\Repository\Specification;

class OrSpecification extends CompositeSpecification  
{
    protected $leftSpecification;
    protected $rightSpecification;

    public function __construct(ISpecification $left, ISpecification $right)  {
        $this->leftSpecification = $left;
        $this->rightSpecification = $right;
    }

    public function IsSatisfiedBy(ISpecificationProvider $provider)  {
        $this->leftSpecification->IsSatisfiedBy($provider);
        $provider->isOr();
        $this->rightSpecification->IsSatisfiedBy($provider);
    }
}