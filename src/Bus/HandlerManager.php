<?php

namespace DDD\Bus;

class HandlerManager implements IHandlerManager
{
    protected $handlers;
    public function __construct()
    {
        $this->handlers = array();
    }
    public function addHandler($type, IHandler $handler)
    {
        if (!array_key_exists($type, $this->handlers)) {
            $this->handlers[$type] = array();
        }
        $this->handlers[$type][] = $handler;
    }
    public function removeHandler($type, IHandler $handler)
    {
        if (!array_key_exists($type, $this->_handlers)) {
            return false;
        }
        $this->handlers[$type][] = $handler;
        $index = array_search($handler, $this->handlers);
        if (!$index) {
            return false;
        }
        array_splice($this->handlers, $index, 1);
        return true;
    }
    public function getHandlers($type)
    {
        if (!array_key_exists($type, $this->handlers)) {
            return array();
        }
        return $this->handlers[$type];
    }
}