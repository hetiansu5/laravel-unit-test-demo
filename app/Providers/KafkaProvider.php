<?php

namespace App\Providers;

use App\Services\KafkaService;
use Illuminate\Support\ServiceProvider;

class KafkaProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('kafka', function () {
            return new KafkaService();
        });
    }
}
