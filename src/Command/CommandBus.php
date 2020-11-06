<?php

namespace DDD\Command;

use DDD\Bus\IHandlerManager;

class CommandBus implements ICommandBus
{
    protected $handlerManager;
    public function __construct(IHandlerManager $handlerManager)
    {
        $this->handlerManager = $handlerManager;
    }
    public function subscribe($commandType, ICommandHandler $commandHandler)
    {
        if(!is_subclass_of($commandType,ICommand::class))
        {
            throw new \TypeError("The commandType is not subclass of ICommand");
        }
        $this->handlerManager->addHandler($commandType, $commandHandler);
    }
    public function unsubscribe($commandType,ICommandHandler $commandHandler)
    {
        if(!is_subclass_of($commandType,ICommand::class))
        {
            throw new \TypeError("The commandType is not subclass of ICommand");
        }
        $this->handlerManager->removeHandler($commandType, $commandHandler);
    }
    public function publish(ICommand $command)
    {
        $handlers = $this->handlerManager->getHandlers(get_class($command));
        foreach ($handlers as $handler) {
            $handler->handle($command);
        }
    }
}
