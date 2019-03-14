<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\_base;
//use dq78\isklep_api_client\apiResponse\ApiResponse;


abstract class CurlBase extends \stdClass
{
    protected $curl = null;
    protected $conf = array(
        'GET' => array(
            CURLOPT_PROTOCOLS => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
        ),
    );
    protected $params = array();

    protected $initError = 0;

    protected $curlErrorNo = 0;
    protected $curlHttpCode = 200;

    protected $response = null;


    abstract public function __construct(array $params = array());

//    abstract public function __set(string $name, $value): void;

    abstract public function getRequest(string $url, array $params = array()): void;
    abstract public function postRequest(string $url, array $post, array $params = array()): void;

    abstract protected function createApiAccess(): string;

    public function getErrorOccurred():bool
    {
        return $this->errorOccurred;
    }

    public function getErrorType():int
    {
        return $this->errorOn;
    }

    abstract public function getResponse():\stdClass;
    abstract public function getResponseCode():array;
}
