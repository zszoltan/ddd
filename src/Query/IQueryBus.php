<?php

namespace DDD\Query;

interface IQueryBus
{

    public function subscribe($queryType, IQueryHandler $queryHandler);
    public function unsubscribe($queryType,IQueryHandler $queryHandler);
    public function publish(IQuery $query);

}
