<?php

namespace DDD\Repository\Specification;

class GroupSpecification extends CompositeSpecification
{

    protected $root;
    protected $specification;

    public function __construct()
    {
    }
    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        if ($this->root !== null) {
            $provider->group(function ($provider) {
                $this->root->IsSatisfiedBy($provider);
            });
        }

        return true;
    }
    public function And(ISpecification $specification): ISpecification
    {
        if($this->root === null)
        {
            $this->specification = new AndSpecification(new NullSpecification(), $specification);
            $this->root =$this->specification;
        }
        else
        {
            $newRight = new AndSpecification($this->specification->getRight(), $specification);
            $this->specification->setRight($newRight);
            $this->specification=$newRight;
        }
        return $this;
    }
    public function Or(ISpecification $specification): ISpecification
    {

        if($this->root === null)
        {
            $this->specification = new OrSpecification(new NullSpecification(), $specification);
            $this->root =$this->specification;
        }
        else
        {
            $newRight = new OrSpecification($this->specification->getRight(), $specification);
            $this->specification->setRight($newRight);
            $this->specification=$newRight;
        }
        return $this;
    }
    /* public function Not(ISpecification $specification) : ISpecification   
    {
        return new NotSpecification($specification);
        $this->specification = new OrSpecification($this->specification, $specification);
        return $this->specification;
    }*/
}
