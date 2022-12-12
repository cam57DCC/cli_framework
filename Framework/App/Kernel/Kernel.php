<?php


namespace Cam57\Framework\App\Kernel;

class Kernel implements KernelInterface
{
    protected array $commands = [];

    public function getCommands(): array
    {
        return $this->commands;
    }
}