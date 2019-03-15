<?php

namespace dq78\isklep_api_client\producer;

use dq78\isklep_api_client\_base\ShowResponce;

class ProducersCreateOne implements ShowResponce
{
    private $producers = null;
    public function __construct(Producers $producers)
    {
        $this->producers = $producers;
    }

    public function showResponceObject(): void
    {
        $resp = $this->producers->getAccessResponse();

        if (!empty($resp->data->producer)) {
            $ob = new ProducerObj(get_object_vars($resp->data->producer));
            echo 'Added record: '.$ob.PHP_EOL;
        } else {
            echo 'No information about added record....'.PHP_EOL;
        }

        return;
    }
}