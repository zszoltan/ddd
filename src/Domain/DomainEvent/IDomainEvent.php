<?php

namespace DDD\Domain;

use DDD\EventBus\IEvent;

interface IDomainEvent extends IEvent
{

    /**
     * @return \DateTime
     */
    public function occurredOn();
}