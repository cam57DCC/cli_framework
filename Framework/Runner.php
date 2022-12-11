<?php

namespace Cam57\Framework;

use Cam57\Framework\App\Cli;
use Cam57\Framework\Command\Command;

class Runner implements RunnerInterface
{
    private Cli $cli;

    private string $defaultCommand = 'list';

    public function __construct(Cli $cli)
    {
        $this->cli = $cli;
    }

    public function run()
    {
        $name = $this->getNameCommand();
        /* @var Command */
        $command = $this->cli->getCommandByName($name);
        $command->execute();
    }

    /**
     * @return string
     */
    private function getNameCommand(): string
    {
        $argv = $_SERVER['argv'];
        if ($this->validCommand($argv)) {
            return $argv[1];
        }
        if (count($argv) > 1) {
            print "Command not valid!\n";
        }

        return $this->defaultCommand;
    }

    private function validCommand(array $args): bool
    {
        return key_exists(1, $args) && preg_match('/^[a-zA-Z_-]+$/', $args[1]);
    }
}