<?php

interface IEvent
{
    public function store(IEvent $event);
}