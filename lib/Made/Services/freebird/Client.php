<?php

namespace Made\Services\freebird;

class Client
{

	/**
	 * Create a new Freebird
	 * @param [string] $consumer_key    [Twitter Application Consumer Key]
	 * @param [string] $consumer_secret [Twitter Application Consumer Secret Key]
	 */
	public function __construct ($consumer_key, $consumer_secret) {

		$this->requestHandler = new RequestHandler();
		
		// Establishes Twitter Applications Authentication token for this session.
		$this->requestHandler->authenticateApp($consumer_key, $consumer_secret);

	}

	public function api_request ($path, $options){

		$data = $this->requestHandler->request($path, $options);
		return json_encode($data->json);

	}

}
