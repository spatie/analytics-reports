<?php namespace Spatie\AnalyticsReports;
use Illuminate\Support\ServiceProvider;
use Config;

class AnalyticsReportsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bindShared('googleanalyticsreports', function($app)
        {
            $client = $app->make('analytics');
            $analyticsApi = new AnalyticsReports($client, Config::get('analyticsReports.siteId'), Config::get('analyticsReports.cacheLifetime'));
            return $analyticsApi;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */

    public function provides()
    {
        return ['googleanalyticsreports'];
    }

}