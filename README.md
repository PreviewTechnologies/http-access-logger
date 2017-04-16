#### Simple HTTP Access Logger
Simple but powerful HTTP access logger and usage monitoring. Mostly it will help to 
monitor API usage and anytime you can add your database storage to save
all the usages.

Currently [Google DataStore](https://cloud.google.com/datastore) has been added as a Storage Provider. Everybody welcome to 
add more provider to it.

[![License](https://img.shields.io/packagist/l/previewtechs/http-access-logger.svg)](https://github.com/PreviewTechnologies/http-access-logger/blob/master/LICENSE)
[![Build Status](https://api.travis-ci.org/PreviewTechnologies/http-access-logger.svg?branch=master)](https://travis-ci.org/PreviewTechnologies/http-access-logger)
[![Code Coverage](https://scrutinizer-ci.com/g/PreviewTechnologies/http-access-logger/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PreviewTechnologies/http-access-logger/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/PreviewTechnologies/http-access-logger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PreviewTechnologies/http-access-logger/?branch=master)

#### Usage

Install with `composer require previewtechs/http-access-logger`

```php
<?php
require "vendor/autoload.php";

//Setup your Google Datastore Gateway
$gateway = new \GDS\Gateway\RESTv1('my-google-cloud-project-name');
$dataStore = new \GDS\Store('my-kind-name', $gateway);

//Initialize storage provider
$storage = new \Previewtechs\HTTP\AccessLogger\Providers\GoogleDataStore($dataStore);

/**
 * Now start recording your HTTP access log by providign your storage provider and Psr/http-message ServerRequestInterface
 * compatible $request object
 */
$log = new \Previewtechs\HTTP\AccessLogger\AccessLog($request, $storage);
$log->record();
```

For bug and issues please open an issue. 


#### Contribution
Keep it simple but we can add more and more Storage provider like (MySQL, MongoDB and other storage);

To build a new provider please see `src/Providers/GoogleDataStore.php`