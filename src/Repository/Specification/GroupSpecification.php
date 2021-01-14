<?php

namespace DDD\Repository\Specification;

class GroupSpecification extends CompositeSpecification
{

    protected $specification;

    public function __construct()
    {
        $this->specification = new NullSpecification();
    }
    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        if($this->specification !== null)
        {
            $provider->group(function($provider) use($this)
            {
                $this->specification->IsSatisfiedBy($provider);
            });
        }
        return true;
    }
    public function And(ISpecification $specification): ISpecification     
    {
        $this->specification = new AndSpecification($this->specification, $specification);
        return $this->specification;
    }
    public function Or(ISpecification $specification) : ISpecification  
    {
        $this->specification = new OrSpecification($this->specification, $specification);
        return $this->specification;
    }
   /* public function Not(ISpecification $specification) : ISpecification   
    {
        return new NotSpecification($specification);
        $this->specification = new OrSpecification($this->specification, $specification);
        return $this->specification;
    }*/

}