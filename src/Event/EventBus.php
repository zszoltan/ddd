<?php

namespace DDD\Event;

use DDD\Bus\IHandlerManager;

class EventBus implements IEventBus
{
    protected $handlerManager;
    public function __construct(IHandlerManager $handlerManager)
    {
        $this->handlerManager = $handlerManager;
    }
    public function subscribe($eventType, IEventHandler $eventHandler)
    {
        if(!is_subclass_of($eventType,IEvent::class))
        {
            throw new \TypeError("The eventType is not subclass of IEvent");
        }
        $this->handlerManager->addHandler($eventType, $eventHandler);
    }
    public function unsubscribe($eventType,IEventHandler $eventHandler)
    {
        if(!is_subclass_of($eventType,IEvent::class))
        {
            throw new \TypeError("The eventType is not subclass of IEvent");
        }
        $this->handlerManager->removeHandler($eventType, $eventHandler);
    }
    public function publish(IEvent $event)
    {
        $handlers = $this->handlerManager->getHandlers(get_class($event));
        foreach ($handlers as $handler) {
            $handler->handle($event);
        }
    }
}
