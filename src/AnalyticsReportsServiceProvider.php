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
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('spatie/analytics-reports');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bindShared('analytics-reports', function($app)
        {
            $client = $app->make('analytics');
            $analyticsApi = new AnalyticsReports($client, $app['config']->get('analytics-reports::siteId'), $app['config']->get('analytics-reports::cacheLifetime'));
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
        return ['analytics-reports'];
    }

}