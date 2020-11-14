<?php

namespace DDD\Mediator;

use DDD\Command\ICommand;
use DDD\Event\IEvent;

interface IMediator
{
    public function publishEvent(IEvent $event);
    public function sendCommand(ICommand $command);
}
