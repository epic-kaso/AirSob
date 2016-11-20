<?php
namespace AirSob;
use AirSob\Exceptions\InvalidConfiguration;
use AirSob\AirSob as AirSobClient;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\ServiceProvider;

class AirSobServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->singleton(AirSobClient::class,function () {
                $config = config('services.airsob');

                if (is_null($config) || empty($config['service_key']) || empty($config['service_id'])) {
                    throw InvalidConfiguration::configurationNotSet();
                }
                
                return new AirSobClient(
                    $config['service_key'],
                    $config['service_id'],
                    data_get($config,'format','json'),
                    app(Log::class)
                );
            });
    }
}