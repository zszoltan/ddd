<?php

namespace DDD\Event;

use DDD\Bus\IHandlerManager;

class StoredEventBus extends EventBus
{
    protected $eventStore;

    public function __construct(IHandlerManager $handlerManager, IEventStore $eventStore)
    {
        parent::__construct($handlerManager);
        $this->eventStore = $eventStore;
    }
    public function publish(IEvent $event)
    {
        $this->eventStore->store($event);
        return parent::publish($event);
    }
}
