<?php

namespace DDD\Event;


interface IEventStore
{
    public function store(IEvent $event);
}