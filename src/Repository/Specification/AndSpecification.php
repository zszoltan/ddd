<?php

namespace DDD\Repository\Specification;

class AndSpecification extends CompositeSpecification  
{
    protected $leftSpecification;
    protected $rightSpecification;

    public function __construct(ISpecification $left, ISpecification $right)  {
        $this->leftSpecification = $left;
        $this->rightSpecification = $right;
    }

    public function IsSatisfiedBy(ISpecificationProvider $provider)  {
         
        $provider->isAnd();
        $this->leftSpecification->IsSatisfiedBy($provider);
         $this->rightSpecification->IsSatisfiedBy($provider);
    }
}