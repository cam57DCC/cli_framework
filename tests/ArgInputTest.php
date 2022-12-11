<?php

use Cam57\Framework\Input\ArgInput;
use PHPUnit\Framework\TestCase;

class ArgInputTest extends TestCase
{
    public function testGetArgs()
    {
        $_SERVER['argv'] = [
            'cli.php', 'command_name',
            '{verbose,overwrite}',
            '[log_file=app.log]',
            '{unlimited}',
            '[methods={create,update,delete}]',
            '[paginate=50]',
            '{log}'
        ];
        $expected= ArgInput::getArgs();
        $actual = [
            'verbose',
            'overwrite',
            'unlimited',
            'log',
        ];
        $this->assertEquals($actual, $expected, ' a hui');
    }
}