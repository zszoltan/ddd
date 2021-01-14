<?php

namespace DDD\Repository;

use InvalidArgumentException;

class Sort
{
    public const ASCENDING = 'ASC';
    public const DESCENDING = 'DESC';

    protected $property;
    protected $direction;

    public function __construct($property,  $direction)
    {
        $direction = (string) strtoupper($direction);
        $this->setDirection($direction);
        $this->setProperty($property);
    }
    public function getProperty()
    {
        return $this->property;
    }
    public function getDirection()
    {
        return $this->direction;
    }
    protected function setProperty($property)
    {
        $this->property = $property;
    }
    protected function setDirection($direction)
    {
        if (false === in_array($direction, [self::ASCENDING, self::DESCENDING], true)) {
            throw new InvalidArgumentException('Only accepted values for direction must be either ASC or DESC');
        }
        $this->direction = $direction;
    }
}
