<?php

namespace DDD\Repository;

use DDD\Repository\Specification\Filter;

interface IRepository
{
    public function count(Filter $filter = null);
    public function find($id);
    public function findBy(Filter $filter = null, Sort $sort = null, Limit $limit = null);
}
