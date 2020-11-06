<?php

namespace DDD\Bus;

interface IHandlerManager
{
    public function addHandler($type, IHandler $handler);
    public function removeHandler($type, IHandler $handler);
    public function getHandlers($type);
}