<?php

namespace DDD\Query;

use DDD\Bus\IHandler;

interface IQueryHandler extends IHandler
{
    public function handle(IQuery $query);
}