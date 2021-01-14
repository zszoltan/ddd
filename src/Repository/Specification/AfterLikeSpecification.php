<?php

namespace DDD\Repository\Specification;

class AfterLikeSpecification extends LikeSpecification
{

    public function IsSatisfiedBy(ISpecificationProvider $provider)
    {
      $provider->likeAfter($this->getProperty(),$this->getValue());
    }

}