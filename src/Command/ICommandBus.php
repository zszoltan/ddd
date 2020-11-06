<?php

namespace DDD\Command;

interface ICommandBus
{

    public function subscribe($commandType,ICommandHandler $commandHandler);
    public function unsubscribe($commandType, ICommandHandler $commandHandler);
    public function publish(ICommand $command);
}
