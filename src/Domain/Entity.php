<?php

namespace DDD\Domain;

use DDD\Collection\GenericCollection;

abstract class Entity
{
    private $_domainEvents;

    public function __construct()
    {
        $this->_domainEvents = new GenericCollection(IDomainEvent::class);
    }
    public function clearDomainEvents()
    {
        !$this->_domainEvents ?: $this->_domainEvents->clear();
    }

    protected function addDomainEvent(IDomainEvent $domainEvent)
    {
        $this->_domainEvents ??= new GenericCollection(IDomainEvent::class);

        $this->_domainEvents->add($domainEvent);
    }

    /* protected function checkRule(IBusinessRule rule)
        {
            if (rule.IsBroken())
            {
                throw new BusinessRuleValidationException(rule);
            }
        }*/
}
