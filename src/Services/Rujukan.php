<?php

namespace EkoSuprianto\EBridgingBpjs\Services;

use EkoSuprianto\EBridgingBpjs\Bpjs;

class Rujukan extends Bpjs {

    protected $multiRecord = false;

    public function find(string $parameter, int $faskes = 1) {
        $response = $this->http::get(
            $faskes == 1 ?
            "/Rujukan/$parameter" :
            "/Rujukan/RS/$parameter"
        );
        return $response;
    }

    public function get(string $parameter, int $faskes = 1) { 
        $response = $this->http::get(
            $this->generateUrl($parameter, $faskes)
        );
        return $response;
    }

    public function create(array $parameters = []) {
        $response = $this->http::post("/Rujukan/2.0/insert", [
            'request' => [
                't_rujukan' => $parameters
            ]
        ]);
        return $response;
    }

    public function update(array $parameters = []) {
        $response = $this->http::put("/Rujukan/2.0/Update", [
            'request' => [
                't_rujukan' => $parameters
            ]
        ]);
        return $response;
    }

    public function delete(array $parameters = []) {
        $response = $this->http::delete("/Rujukan/delete", [
            'request' => [
                't_rujukan' => $parameters
            ]
        ]);
        return $response;
    }

    public function list() {
        $this->multiRecord = true;
        return $this;
    }

    protected function generateUrl(string $parameter, int $faskes = 1) {
        if($this->multiRecord) {
            $url = (
                $faskes == 1 ?
                "/Rujukan/List/Peserta/{$parameter}" :
                "/Rujukan/RS/List/Peserta/{$parameter}"
            );
        }else {
            $url = (
                $faskes == 1 ?
                "/Rujukan/Peserta/{$parameter}" :
                "/Rujukan/RS/Peserta/{$parameter}"
            );
        }

        return $url;
    }

    public function __destruct()
    {
        $this->multiRecord = false;
    }
}
