<?php

namespace DDD\Query;

use DDD\Bus\IHandlerManager;

class QueryBus implements IQueryBus
{
    protected $handlerManager;
    public function __construct(IHandlerManager $handlerManager)
    {
        $this->handlerManager = $handlerManager;
    }
    public function subscribe($queryType,IQueryHandler $queryHandler)
    {
        if(!is_subclass_of($queryType,IQuery::class))
        {
            throw new \TypeError("The queryType is not subclass of IQuery");
        }
        $this->handlerManager->addHandler($queryType, $queryHandler);
    }
    public function unsubscribe($queryType,IQueryHandler $queryHandler)
    {
        if(!is_subclass_of($queryType,IQuery::class))
        {
            throw new \TypeError("The queryType is not subclass of IQuery");
        }
        $this->handlerManager->removeHandler($queryType, $queryHandler);
    }
    public function publish(IQuery $query)
    {
        $handlers = $this->handlerManager->getHandlers(get_class($query));
        foreach ($handlers as $handler) {
            $handler->handle($query);
        }
    }
}
