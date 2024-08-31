<?php

namespace EkoSuprianto\EBridgingBpjs\Services;

class HttpRequest {

    protected $config;
    protected $method;
    protected $options;
    protected $headers;
    protected $statusCode;
    protected $err;

    public function __construct() {
        $this->config = (object) config('vclaim');
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function get($url) {

        date_default_timezone_set('UTC');
        $tStamp                 = createTimestamp();
        $signature              = createSignature($this->config->api_key, $this->config->secret_key, $tStamp);
        $encodedSignature       = base64_encode($signature);
        $response = $this->send([
            CURLOPT_URL 				=> config('vclaim.base_url') . $url,
            CURLOPT_RETURNTRANSFER 	=> true,
            CURLOPT_ENCODING 			=> "",
            CURLOPT_MAXREDIRS 		=> 10,
            CURLOPT_TIMEOUT => (config('vclaim.timeout') * 100),
            CURLOPT_CONNECTTIMEOUT => (config('vclaim.timeout_connection') * 100),
            CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST 	=> 'GET',
            CURLOPT_SSL_VERIFYPEER 	=> 0,
            CURLOPT_HTTPHEADER 		=> createHeaders(
                $this->config->api_key,
                $encodedSignature,
                $this->config->user_key,
                $tStamp
            )
        ]);

        if($this->statusCode == 200) {
            $response = json_decode($response, true);
            return $this->stringDecrypt(createKey(
                $this->config->api_key, 
                $this->config->secret_key, 
                $tStamp),
                $response['response']
            );
        }

        return $response;
    }

    public function post(string $url, array $data = []) {

        date_default_timezone_set('UTC');
        $tStamp                 = createTimestamp();
        $signature              = createSignature($this->config->api_key, $this->config->secret_key, $tStamp);
        $encodedSignature       = base64_encode($signature);
        $response = $this->send([
            CURLOPT_URL 				=> config('vclaim.base_url') . $url,
            CURLOPT_RETURNTRANSFER 	=> true,
            CURLOPT_ENCODING 			=> "",
            CURLOPT_MAXREDIRS 		=> 10,
            CURLOPT_TIMEOUT => (config('vclaim.timeout') * 100),
            CURLOPT_CONNECTTIMEOUT => (config('vclaim.timeout_connection') * 100),
            CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST 	=> 'POST',
            CURLOPT_SSL_VERIFYPEER 	=> 0,
            CURLOPT_POSTFIELDS 		=> json_encode($data),
            CURLOPT_HTTPHEADER 		=> createHeaders(
                $this->config->api_key,
                $encodedSignature,
                $this->config->user_key,
                $tStamp
            )
        ]);

        if($this->statusCode == 200) {
            $response = json_decode($response, true);
            return $this->stringDecrypt(createKey(
                $this->config->api_key, 
                $this->config->secret_key, 
                $tStamp),
                $response['response']
            );
        }

        return $response;
    }

    public function put(string $url, array $data = []) {

        date_default_timezone_set('UTC');
        $tStamp                 = createTimestamp();
        $signature              = createSignature($this->config->api_key, $this->config->secret_key, $tStamp);
        $encodedSignature       = base64_encode($signature);
        $response = $this->send([
            CURLOPT_URL 				=> config('vclaim.base_url') . $url,
            CURLOPT_RETURNTRANSFER 	=> true,
            CURLOPT_ENCODING 			=> "",
            CURLOPT_MAXREDIRS 		=> 10,
            CURLOPT_TIMEOUT => (config('vclaim.timeout') * 100),
            CURLOPT_CONNECTTIMEOUT => (config('vclaim.timeout_connection') * 100),
            CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST 	=> 'PUT',
            CURLOPT_SSL_VERIFYPEER 	=> 0,
            CURLOPT_POSTFIELDS 		=> json_encode($data),
            CURLOPT_HTTPHEADER 		=> createHeaders(
                $this->config->api_key,
                $encodedSignature,
                $this->config->user_key,
                $tStamp
            )
        ]);

        if($this->statusCode == 200) {
            $response = json_decode($response, true);
            return $this->stringDecrypt(createKey(
                $this->config->api_key, 
                $this->config->secret_key, 
                $tStamp),
                $response['response']
            );
        }

        return $response;
    }

    protected function send(array $options = []) {
        $curl           = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);

        $this->setStatusCode($statusCode);
        $this->setError($err);
        return $response;
    }

    protected function setOptionsCURL($options = []) {
        $this->options = $options;
        return $this;
    }

    protected function setMethod($method = 'GET') {
        $this->method = $method;
        return $this;
    }

    protected function setStatusCode($statusCode = 200) {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function setError($err) {
        $this->err = $err;
        return $this;
    }

    protected function withHeaders($headers = []) {
        $this->headers = $headers;
        return $this;
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