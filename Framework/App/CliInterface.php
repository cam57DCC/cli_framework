<?php

namespace Cam57\Framework\App;

use Cam57\Framework\Command\Command;

interface CliInterface
{
    public function run();

    public function getCommands(): array;

    public function getCommandByName(string $name): Command;
}