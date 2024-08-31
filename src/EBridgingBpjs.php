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
            strlen($data) === 13 ? 
            'Peserta/nokartu/'.$data.'/tglSEP/'.date('Y-m-d') : 
            'Peserta/nik/'.$data.'/tglSEP/'.date('Y-m-d')
        ));
        
        return $response;
    }

    protected function stringDecrypt($key, $string = '')
	{

		//key : consid + conspwd + timestamp request (concatenate string)
		$encrypt_method = 'AES-256-CBC';

		// hash
		$key_hash = hex2bin(hash('sha256', $key));

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

		return self::decompress($output);
	}

	protected static function decompress($string)
	{
		return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
	}
}