<?php

use DDD\EventBus\IEvent;
use DDD\EventBus\IEventHandler;
use DDD\EventBus\IEventBus;
use DDD\EventBus\EventBusSubscriptionsManager;

class DomainEventBus implements IEventBus
{
    private  $_handlers;
    public function __construct()
    {
        $this->_handlers = new EventBusSubscriptionsManager();
    }
    public function subscribe(IEventHandler $eventHandler)
    {
        $this->_handlers->addSubscription($eventHandler->getHandledEventType(), $eventHandler);
    }
    public function publish(IEvent $event)
    {
        $eventType = get_class($event);

        $eventHandlers = $this->_handlers->getAll($eventType);

        foreach ($eventHandlers as $handler) {

            $handler->handle($event);
        }
    }
}
