<?php


namespace Cam57\Framework\App\Kernel;

class Kernel implements KernelInterface
{
    protected array $commands = [];

    public function bootstrap()
    {
        foreach ($this->commands as $command){
            if (!class_exists($command, false)) {
                throw new \LogicException(sprintf('Class %s not found', $command));
            }
        }
    }

    public function getCommands(): array
    {
        return $this->commands;
    }
}