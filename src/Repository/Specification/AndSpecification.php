<?php

namespace DDD\Repository\Specification;

class AndSpecification extends CompositeSpecification  
{
    protected $leftSpecification;
    protected $rightSpecification;

    public function getRight()
    {
        return $this->rightSpecification;

    }
    public function setRight(ISpecification $specification)
    {
$this->rightSpecification = $specification;
    }

    public function __construct(ISpecification $left, ISpecification $right)  {
        $this->leftSpecification = $left;
        $this->rightSpecification = $right;
    }

    public function IsSatisfiedBy(ISpecificationProvider $provider)  {
         
        $this->leftSpecification->IsSatisfiedBy($provider);
        $provider->isAnd();
         $this->rightSpecification->IsSatisfiedBy($provider);
    }
}