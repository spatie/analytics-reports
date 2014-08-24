Retrieve data from Google Analytics
=================
[![Latest Stable Version](https://poser.pugx.org/spatie/analytics-reports/version.png)](https://packagist.org/packages/spatie/analytics-reports)
[![License](https://poser.pugx.org/spatie/analytics-reports/license.png)](https://packagist.org/packages/spatie/analytics-reports)

This is an opinionated Laravel 4 package to retrieve Google Analytics data.

Mostly all methods will return an `Illuminate\Support\Collection`-instance.


## Installation

This package can be installed through Composer.

```js
{
    "require": {
		"spatie/analytics-reports": "dev-master"
	}
}
```

You must install this service provider.

```php

// app/config/app.php

'providers' => [
    '...',
    'Spatie\AnalyticsReports\\AnalyticsReportsServiceProvider'
];
```

GoogleSearch also comes with a facade, which provides an easy way to call the the class.


```php

// app/config/app.php

'aliases' => array(
	...
	'AnalyticsReports' => 'Spatie\AnalyticsReports\Facades\AnalyticsReportsFacade',
)
```

Although the composer.json of this package specifies that XX AND xx must be pulled in as well, it sometimes fails to do so. If you encouter this problem as well include these lines in your composer.json as well:
```js
{
    "require": {
    ...
        "google/apiclient" : "1.0.*@beta",
        "thujohn/analytics": "dev-master",
	...
	}
}
```

You can publish the config file of the package using artisan

```bash
php artisan config:publish spatie/analytics-reports
```
After the config file has been published you'll manually have to move it to your app's config-folder. (Hopefully this step won't be necessary in a next version)


In the config file you can specify two values:
- siteId: the Google site id, something in the form of ga:xxxxxxxx
- cacheLifeTime: the amount of minutes the Google API responses will be cached. If you set this value to zero, the responses won't be cached at all.

Internally this package uses [thujohn/analytics-l4](https://github.com/thujohn/analytics-l4) to authenticate with Google. So in order to use this package you must also follow [their installation instructions](https://github.com/thujohn/analytics-l4#installation)



## Usage


When the installation is done you can easily retrieve Analytics data


Here is an example to retrieve visitors and pageview data for the last seven days.
```php
/*
* $analyticsData now contains a Collection with 3 columns: "date", "visitors" and "pageviews"
*/
$analyticsData = AnalyticsReports::getVisitorsAndPageViews(7)
```

Here's another example to get the 20 most visited pages of the last 365 days
```php
/*
* $analyticsData now contains a Collection with 2 columns: "url" and "pageviews"
*/
$analyticsData = AnalyticsReports::getMostVisitedPages(365, 20)
```

