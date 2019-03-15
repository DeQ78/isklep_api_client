<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\producer;

use dq78\isklep_api_client\_base\ShowResponce;

class ProducersGetAll implements ShowResponce
{
    private $producers = null;

    public function __construct(Producers $producers)
    {
        $this->producers = $producers;
    }

    public function showResponceObject(): void
    {
        $resp = $this->producers->getAccessResponse();

        if (!empty($resp->data->producers)) {
            foreach ($resp->data->producers as $key => $prod_) {
                $prod = new ProducerObj(get_object_vars($prod_));
                echo $prod . PHP_EOL;
            }
        }

        return;
    }
}
