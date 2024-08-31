<?php

/**
 * 
 */
if(!function_exists('createSignature')) {
    function createSignature(string $api_key, string $secret, string $tStamp) {
        return hash_hmac('sha256', $api_key . "&" . $tStamp, $secret, true);
    }
}

/**
 * 
 */
if(!function_exists('createTimestamp')) {
    function createTimestamp() {
        return strval(time() - strtotime('1970-01-01 00:00:00'));
    }
}

/**
 * 
 */
if(!function_exists('createHeaders')) {
    function createHeaders(string $api_key, string $signature, string $user_key, $tStamp) {
        return [
            "Cache-Control: no-cache",
            "Content-Type: application/x-www-form-urlencoded",
            "X-cons-id: " . $api_key,
            "Accept: application/json",
            "X-signature: " . $signature,
            "X-timestamp: " . $tStamp,
            "user_key: " . $user_key
        ];
    }
}

/**
 * 
 */
if(!function_exists('createKey')) {
    function createKey(string $api_key, string $secret, $tStamp) {
        return $api_key.$secret.$tStamp;
    }
}
