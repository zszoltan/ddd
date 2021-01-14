<?php 

namespace DDD\Repository\Specification;

abstract class CompositeSpecification implements ISpecification 
{
    public abstract function IsSatisfiedBy(ISpecificationProvider $provider);

    public function And(ISpecification $specification): ISpecification     
    {
        return new AndSpecification($this, $specification);
    }
    public function Or(ISpecification $specification) : ISpecification  
    {
        return new OrSpecification($this, $specification);
    }
    public function Not(ISpecification $specification) : ISpecification   
    {
        return new NotSpecification($specification);
    }
} 