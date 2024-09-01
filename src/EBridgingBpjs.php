<?php

namespace EkoSuprianto\EBridgingBpjs;

use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;
use EkoSuprianto\EBridgingBpjs\Services\Peserta;

class EBridgingBpjs {
    
    protected $peserta;
    protected $result;
    public function __construct(Peserta $peserta) {
        $this->peserta = $peserta;
    }

    public function __get($name)
    {
        return (object) $this->result->$name;
    }

    public function peserta(string $parameter, string $tanggalSEP = null) {
        $this->result = $this->peserta->get($parameter, $tanggalSEP);
        return $this->result;
    } 
}