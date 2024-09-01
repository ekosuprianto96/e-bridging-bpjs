<?php

namespace EkoSuprianto\EBridgingBpjs;

use EkoSuprianto\EBridgingBpjs\Facades\HttpFacades;
use Illuminate\Support\ServiceProvider;
use EkoSuprianto\EBridgingBpjs\Services\HttpRequest;
use EkoSuprianto\EBridgingBpjs\Services\Peserta;

class BPJSServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(HttpRequest::class, function () {
            return new HttpRequest();
        });

        $this->app->singleton(EBridgingBpjs::class, function () {
            return new EBridgingBpjs(
                new Peserta(new HttpFacades)
            );
        });
    }

    public function boot()
    {
        // Load the configuration file
        $this->mergeConfigFrom(
            __DIR__.'/../config/vclaim.php', 'vclaim'
        );

        // Publish the configuration file
        $this->publishes([
            __DIR__.'/../config/vclaim.php' => config_path('vclaim.php'),
        ]);
    }
}