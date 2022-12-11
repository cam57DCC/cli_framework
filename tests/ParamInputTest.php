<?php

use Cam57\Framework\Input\ParamInput;
use PHPUnit\Framework\TestCase;

class ParamInputTest extends TestCase
{
    public function testGetParams()
    {
        $_SERVER['argv'] = [
            'cli.php', 'command_name',
            '{verbose,overwrite}',
            '[log_file=app.log]',
            '{unlimited}',
            '[methods={create,update,delete}]',
            '[paginate=50]',
            '{log}',
            '[name]'
        ];
        $param_input = new ParamInput();
        $expected = $param_input->getParams();
        $actual = [
            'log_file' => 'app.log',
            'methods' => ['create', 'update', 'delete'],
            'paginate' => '50',
        ];
        $this->assertEquals($actual, $expected, 'Failure testGetParams');
    }

    public function testGetParam()
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
        $param_input = new ParamInput();
        $param_input->getParams();
        $expected = $param_input->getParam('log_file');
        $actual = 'app.log';
        $this->assertEquals($actual, $expected, 'Failure testGetParam');
    }
}