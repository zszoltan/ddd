<?php

namespace DDD\Repository\Specification;


interface ISpecificationProvider
{
    function like($property,$value);
    function likeAfter($property,$value);
    function likeBefore($property,$value);
    function equal($property,$value);
    function greaterThan($property,$value);
    function greaterOrEqualThan($property,$value);
    function lessThan($property,$value);
    function lessOrEqualThan($property,$value);

    function in($property,array $array);
  
    function isOr();
    function isAnd();

    function group(Callable $func);
}