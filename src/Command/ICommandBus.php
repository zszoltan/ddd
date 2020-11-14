<?php

namespace DDD\Command;

interface ICommandBus
{

    public function registerHandler(ICommandHandler $commandHandler);
    public function unregisterHandler(ICommandHandler $commandHandler);
    public function publish(ICommand $command);
}
