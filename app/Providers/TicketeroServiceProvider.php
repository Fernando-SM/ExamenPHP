<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TicketeroServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('TicketeroClient', function ($app) {
            return new \GuzzleHttp\Client([
                'base_uri' => env('TICKETERO_API_URL'), // URL base de la API
                'headers' => [
                    'Authorization' => 'Bearer' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
            ]);
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
