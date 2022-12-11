<?php

namespace Cam57\Framework\App\Kernel;

interface KernelInterface
{
    public function bootstrap();

    public function getCommands();
}