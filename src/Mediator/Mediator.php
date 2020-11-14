<?php

namespace DDD\Mediator;

use DDD\Command\ICommand;
use DDD\Command\ICommandBus;
use DDD\Event\IEvent;
use DDD\Event\IEventBus;

class Mediator implements IMediator
{
    protected $eventBus;
    protected $commandBus;
    public function __construct(ICommandBus $commandBus,IEventBus $eventBus)
    {
        $this->commandBus = $commandBus;
        $this->eventBus = $eventBus;
    }
    public function publishEvent(IEvent $event)
    {
        return $this->eventBus->publish($event);
    }
    public function sendCommand(ICommand $command)
    {
        return $this->commandBus->publish($command);
    }
}