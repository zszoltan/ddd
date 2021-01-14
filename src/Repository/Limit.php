<?php

namespace DDD\Repository;

class Limit
{
    protected $limit;
    protected $offset;

    public function __construct($limit, $offset)
    {
        $this->setLimit($limit);
        $this->setOffset($offset);
    }
    public function getLimit()
    {
        return $this->limit;
    }
    public function getOffset()
    {
        return $this->offset;
    }
    protected function setLimit($limit)
    {
        $this->limit = $limit;
    }
    protected function setOffset($offset)
    {
        $this->offset = $offset;
    }
}