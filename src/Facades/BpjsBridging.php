<?php

namespace EkoSuprianto\EBridgingBpjs\Facades;
use Illuminate\Support\Facades\Facade;

class BpjsBridging extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'eBridgingBpjs';
    }
}