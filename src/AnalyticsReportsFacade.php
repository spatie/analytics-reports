<?php namespace Spatie\AnalyticsReports;

use Illuminate\Support\Facades\Facade;

class AnalyticsReportsFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'analytics-reports';
    }

}
