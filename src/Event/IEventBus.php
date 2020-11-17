<?php 

namespace DDD\Event;

interface IEventBus
{
    public function subscribe($eventType,IEventHandler $eventHandler);
    public function unsubscribe($eventType,IEventHandler $eventHandler);
    public function publish(IEvent $events);

}
