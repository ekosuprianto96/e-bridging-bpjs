<?php

namespace EkoSuprianto\EBridgingBpjs\Services;

use EkoSuprianto\EBridgingBpjs\Bpjs;
use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;

class Peserta extends Bpjs {


    public function get(string $data, string $tanggalSEP = null) { 

        if(empty($tanggalSEP)) $tanggalSEP = date('Y-m-d');
        $response = $this->http::get((
            strlen($data) <= 13 ? 
            "Peserta/nokartu/{$data}/tglSEP/{$tanggalSEP}" : 
            "Peserta/nik/{$data}/tglSEP/{$tanggalSEP}"        
        ));
        
        return $response;
    }


}