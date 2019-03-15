<?php
declare(strict_types=1);

namespace dq78\isklep_api_client;

use dq78\isklep_api_client\_base\CurlBase;

class ApiClient extends CurlBase
{
    protected $curl = null;
    protected $conf = array(
        'GET' => array(
            CURLOPT_PROTOCOLS => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
        ),
        'POST' => array(
            CURLOPT_PROTOCOLS => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
        ),
    );
    protected $params = array();


    public function __construct(array $params = array())
    {
        if (!empty($params))
            $this->params = $params;

        $this->curl = curl_init();
    }

    public function getRequest(string $url, array $params = array()): void
    {
        $this->response = new \stdClass();

        foreach ($this->conf['GET'] as $k => $v) {
            curl_setopt($this->curl, $k, $v);
        }

        if (!empty($params)) {
            foreach ($params as $k => $v) {
                curl_setopt($this->curl, $k, $v);
            }
        }

        if (strpos($url, 'https://') === 0) {
//        if (strpos($url, 'http://') === 0) {
            curl_setopt($this->curl, CURLOPT_PORT, 443);
        } elseif (strpos($url, 'http://') === 0) {
            curl_setopt($this->curl, CURLOPT_PORT, 80);
        } else {
            $this->initError = 1;
            return;
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->createApiAccess());


        $response = curl_exec($this->curl);
        $this->response = json_decode($response);
        if (is_null($this->response))
            $this->response = new \stdClass();

        $this->curlErrorNo = curl_errno($this->curl);
        $this->curlHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        return;
    }

    public function postRequest(string $url, array $post, array $params = array()): void
    {
        $this->response = new \stdClass();

        foreach ($this->conf['POST'] as $k => $v) {
            curl_setopt($this->curl, $k, $v);
        }

        if (!empty($params)) {
            foreach ($params as $k => $v) {
                curl_setopt($this->curl, $k, $v);
            }
        }

        $data_string = json_encode($post);

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string)
        ));

        if (strpos($url, 'https://') === 0) {
//        if (strpos($url, 'http://') === 0) {
            curl_setopt($this->curl, CURLOPT_PORT, 443);
        } elseif (strpos($url, 'http://') === 0) {
            curl_setopt($this->curl, CURLOPT_PORT, 80);
        } else {
            $this->initError = 1;
            return;
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_USERPWD, $this->createApiAccess());


        $response = curl_exec($this->curl);

        $this->response = json_decode($response);
        if (is_null($this->response))
            $this->response = new \stdClass();

        $this->curlErrorNo = curl_errno($this->curl);
        $this->curlHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        return;
    }

    /**
     * return login:password or empty string if login or password are ampty
     * @return string
     */
    protected function createApiAccess(): string
    {
        return ((empty($this->params['login']) || empty($this->params['pass'])) ? '' : $this->params['login'] . ":" . $this->params['pass']);
    }

    public function getResponseCode(): array
    {
        return array(
            'curlErrorNo' => $this->curlErrorNo,
            'curlHttpCode' => $this->curlHttpCode
        );
    }

    public function getResponse(): \stdClass
    {
        return $this->response;
    }
}
