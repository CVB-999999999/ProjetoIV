<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * 
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\SampleChart::class,
            \App\Charts\ProjectStatus::class,
            \App\Charts\ProjectProf::class,
            \App\Charts\StudentCount::class,
            \App\Charts\StudentCountProf::class,
            \App\Charts\StatusYear::class,
            \App\Charts\StatusYearProf::class
        ]);
    }
}
