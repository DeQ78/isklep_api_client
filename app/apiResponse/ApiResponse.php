<?php
declare(strict_types=1);

namespace dq78\isklep_api_client\apiResponse;

use dq78\isklep_api_client\_base\IsklepBase;
use dq78\isklep_api_client\_base\ShowResponce;

abstract class ApiResponse extends IsklepBase
{
//    protected $apiClientResponse = null;
//    protected $errorOccurred = false;
//    protected $errorOn = 0;
//    protected $curlErrorNo = 0;
//    protected $curlHttpCode = 200;

    protected function showResponce(ShowResponce $showResponce): void
    {
//        - INTERNAL_SERVER_ERROR
//
//        - API_NOT_FOUND
//        - API_VERSION_NOT_FOUND
//        - ROUTE_NOT_FOUND_OR_METHOD_NOT_ALLOWED
//
//        - UNAUTHORIZED    (json)
//        - MALFORMED_REQUEST_BODY (json)
//        - RESOURCE_NOT_FOUND
//        - INVALID_LANG_CODE_IN_QUERY_STRING
//        - INVALID_REQUEST_DATA
//        - INVALID_DATA_FOR_OBJECT


        // -- errors from CURL if no response object
        if ($this->apiClientResponseCode['curlErrorNo'] != 0 && empty(get_object_vars($this->response))) {
            echo 'Error: response CURL' . PHP_EOL;
            return;
        }

        // -- errors from http cod if no response object
        if ($this->apiClientResponseCode['curlHttpCode'] != 200 && empty(get_object_vars($this->response))) {
            echo 'Error request, HTTP Error Code:' . $this->apiClientResponseCode['curlHttpCode'] . PHP_EOL;
            return;
        }

        // -- errors
        if (!empty(get_object_vars($this->response)) &&
            !empty($this->apiClientResponseCode->error->messages)
        ) {
            if (is_array($this->apiClientResponseCode->error->messages)) {
                foreach ($this->apiClientResponseCode->error->messages as $msg) {
                    echo $msg . PHP_EOL;
                }
            }
        }

        $showResponce->showResponceObject();
        return;

    }
}
