<?php

namespace DDD\Command;

use DDD\Bus\IHandler;

interface ICommandHandler extends IHandler
{
    public function handle(ICommand $command);
}