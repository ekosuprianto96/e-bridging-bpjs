<?php

namespace EkoSuprianto\EBridgingBpjs\Facades;
use Illuminate\Support\Facades\Facade;

class HttpFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'httpRequest';
    }
}