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
//        echo 'wyswietlam szczeguly detalu<br/>';
        echo __METHOD__ . '<br/>';


        $resp = $this->producers->getAccessResponse();

        if (!empty($resp->data->producers)) {

//            echo '<pre>';
//            print_r($resp);
//            echo '</pre>';
//
//
//            echo count($resp->data->producers).'<br/>';


            foreach ($resp->data->producers as $key => $prod_) {

//                echo $key;
//                echo '<pre>';
//                print_r(get_object_vars($prod_));
//                echo '</pre>';


                $prod = new ProducerObj(get_object_vars($prod_));
                echo $prod . '<br/>';
            }
        }


        return;
    }
}