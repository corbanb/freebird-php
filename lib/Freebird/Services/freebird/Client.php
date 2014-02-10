<?php

namespace Freebird\Services\freebird;

class Client
{

	/**
	 * Create a new Freebird Client
	 * @param [string] $consumer_key    [Twitter Application Consumer Key]
	 * @param [string] $consumer_secret [Twitter Application Consumer Secret Key]
	 */
	public function __construct () 
	{
		$this->requestHandler = new RequestHandler();
	}

	public function init_bearer_token ($consumer_key, $consumer_secret)
	{
		// Establishes Twitter Applications Authentication token for this session.
		return $this->requestHandler->authenticateApp($consumer_key, $consumer_secret);
	}

	public function set_bearer_token ($bearer_token)
	{
		$this->requestHandler->set_bearer_token($bearer_token);
	}

  public function get_bearer_token ()
  {
    return $this->RequestHandler->get_bearer_token();
  }

	/**
	 * Simple method to make requests to the Twitter API
	 * @param  [string] $path    [description]
	 * @param  [array] $options [description]
	 * @return [json]          [description]
	 */
	public function api_request ($path, $options)
	{
		$data = $this->requestHandler->request($path, $options);
		return json_encode($data->json);
	}

}
