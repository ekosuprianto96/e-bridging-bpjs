<?php

namespace EkoSuprianto\EBridgingBpjs;

use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;

class Bpjs {

    protected $http;
    public function __construct(HttpFacades $http) {
        $this->http = $http;
    }
}