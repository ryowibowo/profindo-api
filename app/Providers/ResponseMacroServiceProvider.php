<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('default', function ($response_code = 200, $message = "Empty", $data = null) {
            if (env('APP_DEBUG', true) && $response_code > 299) {
                if (strpos($message, 'SQLSTATE') !== false) {
                    $message = 'Please Try Again';
                }
            }

            if (env('APP_DEBUG', true) == false) {
                if ($data instanceof \Exception) {
                    $message = 'Something went wrong';
                }
            }            

            return Response::make([
                'status' => $response_code,
                'message' => $message,
                'data' => (is_null($data)) ? (object) null : ((is_array($data)) ? (array) $data : (object) $data),
            ], $response_code);
        });
    }

}
