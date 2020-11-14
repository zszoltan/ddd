<?php

namespace DDD\Command;

use DDD\Bus\IHandlerManager;

class CommandBus implements ICommandBus
{
    protected $handlers = array();
    public function __construct()
    {
        $this->handlers = array();
    }
    public function registerHandler(ICommandHandler $commandHandler)
    {
        if (!is_subclass_of($commandHandler->getHandledCommand(), ICommand::class)) {
            throw new \TypeError("The commandType is not subclass of ICommand");
        }
        $this->handlers[$commandHandler->getHandledCommand()] = $commandHandler;
    }
    public function unregisterHandler(ICommandHandler $commandHandler)
    {
        if (!array_key_exists($commandHandler->getHandledCommand(), $this->_handlers)) {
            return false;
        }
        unset($this->handlers[$commandHandler->getHandledCommand()]);
        return true;
    }
    public function publish(ICommand $command)
    {
        if (!array_key_exists(get_class($command), $this->_handlers)) {
            return null;
        }
        $handler = $this->handlers[get_class($command)];
        return $handler->handle($command);
    }
}
