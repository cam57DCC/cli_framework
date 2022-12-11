<?php

namespace Cam57\Framework\Command;

use Cam57\Framework\App\CliInterface;
use Cam57\Framework\Input\ArgInput;
use Cam57\Framework\Input\ParamInput;

abstract class Command
{
    protected string $name;

    protected string $description;

    protected string $help;

    protected CliInterface $cli;

    protected ParamInput $params;

    public function __construct(CliInterface $cli)
    {
        $this->cli = $cli;
    }

    public function execute()
    {
        $args = ArgInput::getArgs();
        if (in_array('help', $args)) {
            $this->helpHandle();
            return;
        }

        if (!method_exists($this, 'handle')) {
            throw new \LogicException(sprintf('Not implemented method "handle" in %s', self::class));
        }
        $this->params = new ParamInput();
        $this->handle(...$args);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    protected function helpHandle()
    {
        print sprintf("Command %s\n", $this->name);
        print sprintf("\t%s\n", $this->description);
        print "Help:\n";
        print sprintf("\t%s\n", $this->help);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}