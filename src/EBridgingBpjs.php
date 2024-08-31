<?php

namespace EkoSuprianto\EBridgingBpjs;

use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;

class EBridgingBpjs {
    
    protected $http;
    public function __construct(HttpFacades $http) {
        $this->http = $http;
    }

    public function getPeserta(string $data) { 
        $response = $this->http::get((
            strlen($data) <= 13 ? 
            'Peserta/nokartu/'.$data.'/tglSEP/'.date('Y-m-d') : 
            'Peserta/nik/'.$data.'/tglSEP/'.date('Y-m-d')
        ));
        
        return $response;
    }
}