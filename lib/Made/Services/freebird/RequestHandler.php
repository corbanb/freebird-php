<?php

namespace Made\Services\freebird;

/**
 * A request handler for Tumblr authentication
 * and requests
 */
class RequestHandler
{

    private $bearer;
    private $client;

    /**
     * Instantiate a new RequestHandler
     */
    public function __construct()
    {
        
    }

    private function encodeBearer ($consumer_key, $consumer_secret){

        // Create Bearer Token as per Twitter recomends at 
        // https://dev.twitter.com/docs/auth/application-only-auth
        $consumer_key = rawurlencode($consumer_key);
        $consumer_secret = rawurlencode($consumer_secret);
        return base64_encode($consumer_key . ':' . $consumer_secret);

    }

    public function authenticateApp ($consumer_key, $consumer_secret) {

        $bearer_token = $this->encodeBearer($consumer_key, $consumer_secret);

        // Twitter Required Headers
        $headers = array(
            'Authorization' => 'Basic ' . $bearer_token,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
        );

        // Twitter Required Body
        $body = 'grant_type=client_credentials';
        
        $this->client = new \Guzzle\Http\Client('https://api.twitter.com/1.1');
        $response = $this->client->post('/oauth2/token', $headers, $body)->send();
        $data = $response->json();
        $this->bearer = $data['access_token'];
    }

    /**
     * Make a request with this request handler
     *
     * @param string $path    the path to hit
     * @param array  $options the array of params
     *
     * @return \stdClass response object
     */
    public function request($path, $options)
    {
        // Ensure we have options
        //$options ?: array();

        $headers = array(
            'Authorization' => 'Bearer ' . $this->bearer
        );

        // GET requests get the params in the query string
        $request = $this->client->get($path, $headers);
        $request->getQuery()->merge($options);

        // Guzzle throws errors, but we collapse them and just grab the
        // response, since we deal with this at the \Tumblr\Client level
        try {
            $response = $request->send();
        } catch (\Guzzle\Http\Exception\BadResponseException $e) {
            $response = $request->getResponse();
        }

        // Construct the object that the Client expects to see, and return it
        $obj = new \stdClass;
        $obj->status = $response->getStatusCode();
        $obj->body = $response->getBody();
        $obj->headers = $response->getHeaders();
        $obj->json = $response->json();

        return $obj;
    }

}
