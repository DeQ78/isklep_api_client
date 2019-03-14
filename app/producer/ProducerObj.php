<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\producer;


use dq78\isklep_api_client\_base\DataObj;

class ProducerObj extends DataObj
{
    /**
     * @var int null
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $name = '';

    /**@var string * */
    protected $site_url = '';

    /**
     * @var string
     */
    protected $logo_filename = '';

    /**
     * @var int
     */
    protected $ordering = 0;

    /**
     * @var string
     */
    protected $source_id = '';


//    public function __construct(array $params)
//    {
////        echo 'load params = '.print_r($params,true).'<br/>';
//        parent::__construct($params);
//    }

}