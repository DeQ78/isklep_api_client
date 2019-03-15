<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\producer;

use dq78\isklep_api_client\ApiClient;
use dq78\isklep_api_client\apiResponse\ApiResponse;

class Producers extends ApiResponse
{
    protected $confVersion = '1';

    public function __construct(array $apiAccess)
    {
        parent::__construct($apiAccess);

        $this->_loadObjectVars(
            vsprintf(
                $this->_confPath,
                array(
                    __DIR__,
                    substr(strrchr(__CLASS__, "\\"), 1),
                    $this->confVersion
                )
            )
        );
    }

    // --- API methods ---
    public function getAll(): void
    {
        $apiClient = new ApiClient(array('login' => $this->apiAccess['login'], 'pass' => $this->apiAccess['pass']));
        $url = $this->createFullUrl('getAll');

        $apiClient->getRequest($url);

        $this->response = $apiClient->getResponse();
        $this->apiClientResponseCode = $apiClient->getResponseCode();


        $showDetail = new ProducersGetAll($this);


        $this->showResponce($showDetail);
    }

    public function createOne(ProducerObj $obj): void
    {
        $apiClient = new ApiClient(array('login' => $this->apiAccess['login'], 'pass' => $this->apiAccess['pass']));
        $url = $this->createFullUrl('createOne');


        $apiClient->postRequest($url, $obj->getVars());
//        $apiClient->postRequest($url, $obj->getVarsStdClass());

        $this->response = $apiClient->getResponse();
        $this->apiClientResponseCode = $apiClient->getResponseCode();


        $showDetail = new ProducersCreateOne($this);

        $this->showResponce($showDetail);
        return;
    }

}