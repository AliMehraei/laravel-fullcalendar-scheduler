<?php

namespace AliMehraei\FullcalendarScheduler;

use Illuminate\Support\ServiceProvider;

/**
 * Class FullcalendarServiceProvider
 * @package AliMehraei\FullcalendarScheduler
 */
class FullcalendarSchedulerServiceProvider extends ServiceProvider
{
    /** Identifier for the service */
    const IDENTIFIER = 'laravel-fullcalendar-scheduler';

    /**
     * Register bindings in the container.
     * @return void
     */
    public function register()
    {
        $this->app->bind(self::IDENTIFIER, function ($app) {
            return $app->make(FullcalendarScheduler::class);
        });
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        // specify from where we want to load the views
        $this->loadViewsFrom(__DIR__ . '/views/', 'fullcalendar-scheduler');

        // publish the config file
        $this->publishes([
            __DIR__ . '/config/fullcalendar-scheduler.php' => config_path('fullcalendar-scheduler.php'),
        ], 'config');

        // publish all the required files to generate the calendar
        $this->publishes([
            __DIR__ . '/assets/fullcalendar/main.css' => public_path('/vendor/fullcalendar-scheduler/css/main.css'),
            __DIR__ . '/assets/fullcalendar/main.js' => public_path('/vendor/fullcalendar-scheduler/js/main.js'),
            __DIR__ . '/assets/fullcalendar/locales-all.js' => public_path('/vendor/fullcalendar-scheduler/js/locales-all.js'),
            __DIR__ . '/assets/momentjs/moment.js' => public_path('/vendor/momentjs/js/moment.js'),

/*            __DIR__ . '/../../../npm-asset/fullcalendar-scheduler/dist/scheduler.css' => public_path('css/scheduler.css'),
            __DIR__ . '/../../../npm-asset/fullcalendar-scheduler/dist/scheduler.js'  => public_path('js/scheduler.js'),
            // fullcalendar library
            __DIR__ . '/../../../npm-asset/fullcalendar/dist/fullcalendar.css'        => public_path('css/fullcalendar.css'),
            __DIR__ . '/../../../npm-asset/fullcalendar/dist/fullcalendar.print.css'  => public_path('css/fullcalendar.print.css'),
            __DIR__ . '/../../../npm-asset/fullcalendar/dist/fullcalendar.js'         => public_path('js/fullcalendar.js'),
            __DIR__ . '/../../../npm-asset/fullcalendar/dist/locale-all.js'           => public_path('js/locale-all.js'),
            __DIR__ . '/../../../npm-asset/fullcalendar/dist/gcal.js'                 => public_path('js/gcal.js'),
            // moment library
            __DIR__ . '/../../../npm-asset/moment/moment.js'                          => public_path('js/moment.js'),*/
        ], 'fullcalendar-scheduler');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [self::IDENTIFIER];
    }
}
