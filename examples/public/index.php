<?php

require __DIR__ . '/../../vendor/autoload.php';


// test simple return of favs data

$app = new \Slim\Slim();

// setup freebird Client with application keys
$client = new Made\Services\freebird\Client();
//$client->init_bearer_token('your_key', 'your_secret_key');
$client->set_bearer_token('your_bearer');


// set response types to json
$res = $app->response();
$res['Content-Type'] = 'application/json';

$app->get('/favorites/:name', function ($name) use ($app, $client) {

	// request parameters
	$params = array('screen_name' => $name, 'count' => 2);

	// make request to the api
	$data = $client->api_request('favorites/list.json', $params);

	// return data
	$app->response()->body($data);

});

$app->run();
