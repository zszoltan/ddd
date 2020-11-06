<?php


abstract class Context
{
    public function DispatchDomainEventsAsync()
    {
        /*$domainEntities = ctx.ChangeTracker
                .Entries<Entity>()
                .Where(x => x.Entity.DomainEvents != null && x.Entity.DomainEvents.Any());

            $domainEvents = domainEntities
                .SelectMany(x => x.Entity.DomainEvents)
                .ToList();

            $domainEntities.ToList()
                .ForEach(entity => entity.Entity.ClearDomainEvents());

            foreach (var domainEvent in domainEvents)
                await mediator.Publish(domainEvent);*/
    }
}