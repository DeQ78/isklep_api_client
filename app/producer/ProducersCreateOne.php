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
        echo 'wyswietlam szczeguly detalu<br/>';
        echo '<pre>';
        print_r($this);
        echo '</pre>';


        return;
    }
}