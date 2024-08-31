<?php
/**
 * File konfigurasi untuk bridging ke BPJS
 */
return [

    /**
     * 
     */
    'base_url' => 'https://vclaim.bpjs-kesehatan.go.id',

    /**
     * 
     */
    'api_key' => env('VCLAIM_API_KEY', ''),

    /**
     * 
     */
    'secret_key' => env('VCLAIM_SECRET_KEY', ''),

    /**
     * 
     */
    'user_key' => env('VCLAIM_USER_KEY', ''),

    /**
     * 
     */
    'timeout' => env('VCLAIM_TIMEOUT', 30),

    /**
     * 
     */
    'timeout_connection' => env('VCLAIM_TIMEOUT_CONNECTION', 30),
];