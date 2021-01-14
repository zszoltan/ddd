<?php

namespace DDD\Repository\Specification;


interface ISpecification
{
    function IsSatisfiedBy(ISpecificationProvider $provider);
}
