<?php

namespace DDD\Event;

class EventBusSubscriptionsManager
{
    private $_handlers;
    public function __construct()
    {
        $this->_handlers = array();
    }
    public function addSubscription($eventType, $handler)
    {
        if (!array_key_exists($eventType, $this->_handlers)) {
            $this->_handlers[$eventType] = array();
        }
        $this->_handlers[$eventType][] = $handler;
    }
    public function removeSubscription($eventType, $handler)
    {
        if (!array_key_exists($eventType, $this->_handlers)) {
            return false;
        }
        $this->_handlers[$eventType][] = $handler;
        $index = array_search($handler, $this->_handlers);
        if (!$index) {
            return false;
        }
        array_splice($this->_handlers, $index, 1);
        return true;
    }
    public function getAll($eventType)
    {
        if (!array_key_exists($eventType, $this->_handlers)) {
            return array();
        }
        return $this->_handlers[$eventType];
    }
}
