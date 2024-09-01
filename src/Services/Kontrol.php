<?php

namespace EkoSuprianto\EBridgingBpjs\Services;

use EkoSuprianto\EBridgingBpjs\Bpjs;
use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;

class Kontrol extends Bpjs {

    public function find(string $nosurat) {
        $response = $this->http::get("/RencanaKontrol/noSuratKontrol/{$nosurat}");
        return $response;
    }

    public function create(array $parameters = []) {
        $response = $this->http::post("/RencanaKontrol/insert", $parameters);
        return $response;
    }

    public function update(array $parameters = []) {    
        $response = $this->http::put("/RencanaKontrol/Update", [
            'request' => $parameters
        ]);
        return $response;
    }

    public function all(
        string $tglAwal = '01', 
        string $tglAkhir = null,
        int $filter = 1
    ) {

        if(empty($tahun)) $tahun = date('Y');
        $response = $this->http::get(
            "/RencanaKontrol/ListRencanaKontrol/tglAwal/{$tglAwal}/tglAkhir/{$tglAkhir}/filter/{$filter}"
        );
        return $response;
    }

    public function get(
        string $bulan = '01', 
        string $tahun = null, 
        string $nokartu, 
        int $filter = 1
    ) {

        if(empty($tahun)) $tahun = date('Y');
        $response = $this->http::get(
            "/RencanaKontrol/ListRencanaKontrol/Bulan/{$bulan}/Tahun/{$tahun}/Nokartu/{$nokartu}/filter/{$filter}"
        );
        return $response;
    }

    public function delete(array $parameters = []) {
        $response = $this->http::delete("/RencanaKontrol/Delete", [
            'request' => $parameters
        ]);
        return $response;
    }
}