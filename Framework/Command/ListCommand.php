<?php

namespace Cam57\Framework\Command;

class ListCommand extends Command
{

    protected string $name = 'list';

    protected string $description = 'list off available command';

    protected string $help = 'no arguments';

    protected function handle()
    {
        print "Commands:\n";
        /** @var Command $command */
        foreach ($this->cli->getCommands() as $command){
            print sprintf("\t%s\t%s\n", $command->getName(), $command->getDescription());
        }
    }
}