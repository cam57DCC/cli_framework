<?php


namespace Cam57\Framework\Input;

class ParamInput
{
    private array $params = [];

    /**
     * @return array
     */
    public function getParams(): array
    {
        $params = $this->getParamsFromGlobal();
        $this->parseParams($params);
        return $this->params;
    }

    /**
     * @param string $param
     * @param null $default
     * @return mixed|null
     */
    public function getParam(string $param, $default = null)
    {
        if (key_exists($param, $this->params)) {
            return $this->params[$param];
        }
        return $default;
    }

    /**
     * @return array
     */
    private function getParamsFromGlobal(): array
    {
        $params = $_SERVER['argv'];
        array_shift($params);
        array_shift($params);
        return $params;
    }

    /**
     * @param array $params
     */
    private function parseParams(array $params)
    {
        foreach ($params as $param) {
            if ($this->isParams($param)) {
                $param = $this->parseParam($param);
                $explode_param = explode('=', $param, 2);
                $this->setParam($explode_param);
            }
        }
    }

    /**
     * @param string $param
     * @return bool
     */
    private function isParams(string $param): bool
    {
        return $param[0] == '[';
    }

    /**
     * @param string $param
     * @return string
     */
    private function parseParam(string $param): string
    {
        $param = substr($param, 1);
        return substr($param, 0, strlen($param) - 1);
    }

    /**
     * @param array $explode_param
     */
    private function setParam(array $explode_param)
    {
        if (count($explode_param) == 2) {
            if ($explode_param[1][0] == '{') {
                $this->params[$explode_param[0]] = ArgInput::getArgs([$explode_param[1]]);
            } else {
                $this->params[$explode_param[0]] = $explode_param[1];
            }
        }
    }
}