<?php

namespace EkoSuprianto\EBridgingBpjs\Services;

use EkoSuprianto\EBridgingBpjs\Bpjs;

class SEP extends Bpjs {

    public function find(string $parameter) { 
        $response = $this->http::get(
            "/SEP/{$parameter}"
        );
        return $response;
    }

    public function create(array $parameters = []) {
        $response = $this->http::post("/SEP/2.0/insert", [
            'request' => [
                't_sep' => $parameters
            ]
        ]);
        return $response;
    }

    public function update(array $parameters = []) {
        $response = $this->http::put("/SEP/2.0/update", [
            'request' => [
                't_sep' => $parameters
            ]
        ]);
        return $response;
    }

    public function delete(array $parameters = []) {
        $response = $this->http::delete("/SEP/2.0/delete", [
            'request' => [
                't_sep' => $parameters
            ]
        ]);
        return $response;
    }
}