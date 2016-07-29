Retrieve data from Google Analytics
=================
[![Latest Stable Version](https://poser.pugx.org/spatie/analytics-reports/version.png)](https://packagist.org/packages/spatie/analytics-reports)
[![Total Downloads](https://poser.pugx.org/spatie/analytics-reports/downloads.svg)](https://packagist.org/packages/spatie/analytics-reports)
[![License](https://poser.pugx.org/spatie/analytics-reports/license.png)](https://packagist.org/packages/spatie/analytics-reports)

This is an opinionated Laravel 4 package to retrieve Google Analytics data. 

If you're using Laravel 5, [take a look at this package](https://github.com/spatie/laravel-analytics).

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Installation

This package can be installed through Composer. 

```
composer require spatie/analytics-reports
```

You must install this service provider.

```php

// app/config/app.php

'providers' => [
    '...',
    'Spatie\AnalyticsReports\AnalyticsReportsServiceProvider'
];
```

This package also comes with a facade, which provides an easy way to call the the class.


```php

// app/config/app.php

'aliases' => array(
	...
	'AnalyticsReports' => 'Spatie\AnalyticsReports\AnalyticsReportsFacade',
)
```

Although the composer.json of this package specifies that "google/apiclient" AND "thujohn/analytics" must be pulled in as well, it sometimes fails to do so. If you encouter this problem as well include these lines in your composer.json as well:
```js
{
    "require": {
    ...
        "google/apiclient" : "1.1.*",
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

To move the config file copy the ```config.php``` file from 
```
/app/config/packages/spatie/analytics-reports/
```

and paste it to your ```/app/config``` folder and rename it to ```analyticsReports.php```

In the config file you can specify two values:
- siteId: the Google site id, something in the form of ga:xxxxxxxx
- cacheLifeTime: the amount of minutes the Google API responses will be cached. If you set this value to zero, the responses won't be cached at all.

Internally this package uses [thujohn/analytics-l4](https://github.com/thujohn/analytics-l4) to authenticate with Google. So in order to use this package you must also follow [their installation instructions](https://github.com/thujohn/analytics-l4#installation).



## Usage


When the installation is done you can easily retrieve Analytics data. Mostly all methods will return an `Illuminate\Support\Collection`-instance.


Here is an example to retrieve visitors and pageview data for the last seven days.
```php
/*
* $analyticsData now contains a Collection with 3 columns: "date", "visitors" and "pageViews"
*/
$analyticsData = AnalyticsReports::getVisitorsAndPageViews(7)
```

Here's another example to get the 20 most visited pages of the last 365 days
```php
/*
* $analyticsData now contains a Collection with 2 columns: "url" and "pageViews"
*/
$analyticsData = AnalyticsReports::getMostVisitedPages(365, 20)
```
## Provided methods

###Visitors and Pageviews
These methods return a Collection with columns "date", "vistors" and "pageViews". When grouping by yearMonth, the first column will be called "yearMonth".
```php
    /**
     * Get the amount of visitors and pageviews
     *
     * @param int $numberOfDays
     * @param string $groupBy Possible values: date, yearMonth
     * @return Collection
     */
    public function getVisitorsAndPageViews($numberOfDays = 365, $groupBy = 'date')

    /**
     * Get the amount of visitors and pageviews for the given period
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param string $groupBy Possible values: date, yearMonth
     * @return Collection
     */
    public function getVisitorsAndPageViewsForPeriod($startDate, $endDate, $groupBy = 'date')
```    

###Keywords
These methods return a Collection with columns "keyword" and "sessions".
```php
   /**
     * Get the top keywords
     *
     * @param int $numberOfDays
     * @param int $maxResults
     * @return Collection
     */
    public function getTopKeywords($numberOfDays = 365, $maxResults = 30)

    /**
     * Get the top keywords for the given period
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param int $maxResults
     * @return Collection
     */
    public function getTopKeyWordsForPeriod($startDate, $endDate, $maxResults = 30)
```

###Referrers
These methods return a Collection with columns "url" and "pageViews".
```php
    /**
     * Get the top referrers
     *
     * @param int $numberOfDays
     * @param int $maxResults
     * @return Collection
     */
    public function getTopReferrers($numberOfDays = 365, $maxResults = 20)

    /**
     * Get the top referrers for the given period
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param $maxResults
     * @return Collection
     */
    public function getTopReferrersForPeriod($startDate, $endDate, $maxResults)
``` 

###Browsers
These methods return a Collection with columns "browser" and "sessions".

If there are  more used browsers than the number specified in maxResults, then a new resultrow with browser-name "other" will be appended with a sum of all the remaining browsers.
```php
    /**
     * Get the top browsers
     *
     * @param int $numberOfDays
     * @param int $maxResults
     * @return Collection
     */
    public function getTopBrowsers($numberOfDays = 365, $maxResults = 6)
    
    /**
     * Get the top browsers for the given period
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param $maxResults
     * @return Collection
     */
    public function getTopBrowsersForPeriod($startDate, $endDate, $maxResults) 
```     

###Most visited pages
These methods return a Collection with columns "url" and "pageViews".
```php
    /**
     * Get the most visited pages
     *
     * @param int $numberOfDays
     * @param int $maxResults
     * @return Collection
     */
    public function getMostVisitedPages($numberOfDays = 365, $maxResults = 20)
    
    /**
     * Get the most visited pages for the given period
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param int $maxResults
     * @return Collection
     */
    public function getMostVisitedPagesForPeriod($startDate, $endDate, $maxResults = 20)
```

###All other Google Analytics Queries
To perform all other GA queries use  ```performQuery```.  [Google's Core Reporting API](https://developers.google.com/analytics/devguides/reporting/core/v3/common-queries) provides more information on on which metrics and dimensions might be used. 
```php
    /**
     * Call the query method on the autenthicated client
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param $metrics
     * @param array $others
     * @return mixed
     */
    public function performQuery($startDate, $endDate, $metrics, $others = array())
```    

##Convenience methods
```getSiteIdByUrl``` can be used to get the site id for the given url

```php
    /**
     * Returns the site id (ga:xxxxxxx) for the given url
     *
     * @param $url
     * @throws \Exception
     * @return string
     */
    public function getSiteIdByUrl($url)
```           

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).
