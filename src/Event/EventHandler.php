<?php
/*
https://github.com/kgrzybek/modular-monolith-with-ddd/blob/master/src/BuildingBlocks/EventBus/InMemoryEventBus.cs
https://github.com/dddinphp/ddd/blob/master/src/Domain/DomainEventPublisher.php
https://github.com/dddinphp/last-wishes/blob/master/src/Lw/Domain/Model/User/User.php

https://github.com/CodelyTV/php-ddd-example/blob/master/src/Shared/Domain/Bus/Event/DomainEventSubscriber.php
https://stackoverflow.com/questions/26261618/entity-vs-aggregate-vs-aggregate-root

https://github.com/onemustcode/laravel-ddd/blob/master/src/stubs/domain/core/events/EventDispatcherTrait.stub
https://github.com/josecelano/ddd-laravel-sample/blob/f4b905d8cd9c2cbc6717794a462ebc749bf599cb/app/Listeners/Backend/Access/Role/RoleEventListener.php

https://github.com/allysonsilva/laravel-ddd
*/
namespace DDD\Event;

abstract class EventHandler implements IEventHandler
{
    public function __construct()
    {
        
    }
    public function handle(IEvent $event)
    {

    }
}