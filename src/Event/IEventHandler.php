<?php

namespace DDD\Event;

use DDD\Bus\IHandler;

interface IEventHandler extends IHandler
{
    public function handle(IEvent $event);
}
