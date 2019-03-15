<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\_base;


abstract class DataObj extends \stdClass
{
    public function __construct(array $params)
    {
        foreach (get_object_vars($this) as $k => $v) {
            if (array_key_exists($k, $params)) {
                $this->{$k} = $params[$k];
            }
        }
    }

    public function getVars(): array
    {
        return get_object_vars($this);
    }

    public function getVarsStdClass(): \stdClass
    {
        $ob = new \stdClass();
        foreach (get_object_vars($this) as $k => $v) {
            $ob->{$k} = $v;
        }
        return $ob;
    }

    public function __toString(): string
    {
        $ret = '';
        foreach (get_object_vars($this) as $k => $v) {
            $ret .= $k . ' : ' . $v . ';' . PHP_EOL;
        }
        return $ret . PHP_EOL;
    }
}
