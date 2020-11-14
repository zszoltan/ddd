<?php

namespace DDD\Command;

abstract class CommandHandler extends ICommandHandler
{
    private $_handledCommand;
    public function __construct($handledCommandClass)
    {
        if(!is_subclass_of($handledCommandClass,ICommand::class))
        {
            throw new \TypeError("The handledCommandClass is not subclass of ICommand");
        }
        $this->_handledCommand = $handledCommandClass;
    }
    public function getHandledCommand()
    {
        return $this->_handledCommand;
    }
    public abstract function handle(ICommand $command);
}
