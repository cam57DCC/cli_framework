<?php

namespace Cam57\Framework\Input;

class ArgInput
{
    /**
     * @param string|null $args
     * @return array
     */
    public static function getArgs(array $args = null): array
    {
        $result = [];
        $args = empty($args) ? self::getArgsFromGlobal() : $args;
        foreach ($args as $arg) {
            if (self::isArg($arg)) {
                $result = array_merge($result, self::getArg($arg));
            }
        }

        return $result;
    }

    /**
     * @param string $arg
     * @return bool
     */
    private static function isArg(string $arg): bool
    {
        return $arg[0] === '{';
    }

    /**
     * @param string $arg
     * @return array
     */
    private static function getArg(string $arg): array
    {
        $arg = substr($arg, 1);
        $arg = substr($arg, 0, strlen($arg) - 1);
        return explode(',', $arg);
    }

    /**
     * @return array
     */
    private static function getArgsFromGlobal(): array
    {
        $args = $_SERVER['argv'];
        array_shift($args);
        array_shift($args);
        return $args;
    }
}