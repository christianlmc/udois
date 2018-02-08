<?php

namespace Udois\Providers;

use Illuminate\Support\ServiceProvider;

use Symfony\Component\Process\Process;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $process = new Process('node server.js');
        $process->start();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
