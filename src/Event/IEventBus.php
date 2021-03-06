<?php 

namespace DDD\Event;



//https://github.com/PHPMessageBus/messagebus#211---create-a-query
//https://github.com/SimpleBus/MessageBus
//https://github.com/szjani/predaddy/tree/3.0/src/predaddy/eventhandling

interface IEventBus
{
    public function subscribe($eventType,IEventHandler $eventHandler);
    public function unsubscribe($eventType,IEventHandler $eventHandler);
    public function publish(IEvent $events);

}
