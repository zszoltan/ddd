<?php

namespace DDD\Repository\Specification;



class Filter extends GroupSpecification
{
    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
        if ($this->root !== null) {
            $this->root->IsSatisfiedBy($provider);
        }
    }
}
