<?php

namespace Cam57\Framework\App;

use Cam57\Framework\App\Kernel\KernelInterface;
use Cam57\Framework\Command\Command;
use Cam57\Framework\Command\ListCommand;
use Cam57\Framework\Runner;

class Cli implements CliInterface
{
    private KernelInterface $kernel;

    private array $commands = [];

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->kernel->bootstrap();
        $this->addCommands($this->kernel->getCommands());
        $this->addDefaultCommands();
    }

    public function run()
    {
        $runner = new Runner($this);
        $runner->run();
    }

    /**
     * @param array $commands
     */
    private function addCommands(array $commands)
    {
        foreach ($commands as $command){
            $this->addCommand($command);
        }
    }

    private function addCommand(string $command)
    {
        $commandObject = new $command($this);
        $this->commands[$commandObject->getName()] = $commandObject;
    }

    private function addDefaultCommands()
    {
        $this->addCommands($this->getDefaultCommands());
    }

    /**
     * @return array
     */
    private function getDefaultCommands(): array
    {
        return [ListCommand::class];
    }

    /**
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param string $name
     * @return Command
     */
    public function getCommandByName(string $name): Command
    {
        if (key_exists($name, $this->commands)){
            return new $this->commands[$name]($this);
        }

        throw new \LogicException(sprintf('Command %s not found', $name));
    }
}