<?php

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