<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\_base;

use dq78\isklep_api_client\apiResponse\ApiResponse;

abstract class IsklepBase
{
    /**
     * version conf to read by object
     * @var string
     */
    protected $confVersion = '';

    /**
     * pattern for determining the path to the configuration file
     *  __DIR__/__CLASS__.confVersion.json
     * @var string
     */
    protected $_confPath = '%s/%s.%s.json';

    /**
     * @var array - data to configure CURL
     */
    protected $apiAccess = array();

    /**
     * @var array - data with postfixes of urls for each of methods in class for API
     */
    protected $postfix_url = array();

    /**
     * data with respinse
     * @var ApiResponse
     */
    protected $response = null;
    protected $apiClientResponseCode = array();


    // --- --- --- ---
    // --- methods ---
    public function __construct(array $apiAccess)
    {
        $this->apiAccess = $apiAccess;
    }

    /**
     * load params from json file to fields of this->object
     * @param string $path
     * @throws \ErrorException
     */
    protected function _loadObjectVars(string $path): void
    {
        if (!is_file($path))
            throw new \ErrorException('Error find config file: ' . $path);


        $json = json_decode(file_get_contents($path), true);
        if (is_null($json))
            throw new \ErrorException('Error json decode file: ' . $path);

        foreach (get_object_vars($this) as $k => $v) {
            if (array_key_exists($k, $json)) {
                $this->{$k} = $json[$k];
            }
        }
    }

    protected function createFullUrl(string $methodName, array $params = array()): string
    {
        if (empty($this->apiAccess['base_url']) || empty($methodName) || empty($this->postfix_url[$methodName]))
            throw new \ErrorException('Error createFullUrl, unknown postfix url for methodName: ' . $methodName);

        if (!empty($params))
            return vsprintf($this->apiAccess['base_url'] . $this->postfix_url[$methodName], $params);
        else
            return $this->apiAccess['base_url'] . $this->postfix_url[$methodName];
    }

    public function getAccessResponse(): \stdClass
    {
        return $this->response;
    }
}