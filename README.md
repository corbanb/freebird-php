Freebird - Twitter App Only Auth
===

## Welcome

**Freebird** is a simple library designed to make connecting to Twitter's API as simple as possible on the server. Freebird was written to make life as easy as possible on developers to connect thier application servers to Twitter's API. Freebird uses the Application Only Authentication methodology, to find out more on this you can view the docs [here](https://dev.twitter.com/docs/auth/application-only-auth) from the offical Twitter API website. 


## Installing via Composer

The recomended way to install **Freebird** is through [Composer](http://getcomposer.org/). 

```
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add Freebird as a dependency
php composer.phar require corbanb/freebird:~0.1.1
```

After installing, you need to require Composer's autoloader:

```
require 'vendor/autoload.php';
```


## Freebird Dependencies

```
"php": ">=5.3.0"
"guzzle/guzzle": "3.1.*"
```

## Basic Usage

Once installed you can easily access all of the Twitter API endpoints supported by [Application Only Authentication](https://dev.twitter.com/docs/auth/application-only-auth). You can view those enpoints [here](https://dev.twitter.com/docs/rate-limiting/1.1/limits). 

```

<?php

// Setup freebird Client with Twitter application keys
$client = new Freebird\Services\freebird\Client();

// init bearer token
$client->init_bearer_token('your_key', 'your_secret_key');

// optional set bearer token if already aquired
// $client->set_bearer_token('your_bearer_token');


// Request API enpoint data
$response = $client->api_request('favorites/list.json', array('screen_name' => 'corbanb'));

// return api data
echo $response;


```


## Unit Testing

Not complete. Please feel free to fork and submit pull requests to help contribute to **Freebird**. Thanks.

