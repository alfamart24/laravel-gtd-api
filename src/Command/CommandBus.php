<?php

namespace Wstanley\Kitapi\Command;

class CommandBus
{
    public static function handle(CommandInterface $command)
    {
        return get_class_vars(get_class($command));
    }
}