<?php

namespace Wise;

class Client
{

    private $_token;

    private $_profile_id;

    private $_factory = null;

    private $_http_client = false;

    private $_url = "https://api.transferwise.com/";

    /**
     * Initialise Client
     *
     * @param String $token Logged in token
     */
    public function __construct($config)
    {
        if (is_array($config)) {
            $this->_token = $config["token"];
            $this->_profile_id = $config["profile_id"];
            return;
        }

        $this->_token = $config;
    }

    /**
     * Get an exposed service
     *
     * @param String $name Service name
     *
     * @return Service
     */
    public function __get($name)
    {
        if ($this->_factory === null) {
            $this->_factory = new \Wise\Factory\ServiceFactory($this);
        }

        return $this->_factory->__get($name);
    }

    /**
     * Returns Profile ID
     *
     * @return Integer
     */
    public function getProfileId()
    {
        return $this->_profile_id;
    }

    /**
     * Request Call
     *
     * @param String $method GET|POST
     * @param String $path   Api route
     * @param Array  $params request params
     *
     * @return Json
     */
    public function request($method, $path, $params = [])
    {

        if (!$this->_http_client) {
            $this->_http_client = new \GuzzleHttp\Client();
        }

        $data = [
            'headers' => [
                'Authorization' => "Bearer $this->_token",
                'Content-Type' => "application/json"
            ]
        ];

        if ((in_array($method, ["POST", "PUT"]))  && count($params) > 0) {
            $data["json"] = $params;
        }

        try {
            $response = $this->_http_client->request(
                $method,
                $this->_url . $path,
                $data
            );
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            return $this->handleErrors($exception);
        }

        return $this->response($response);
    }


    public function response($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    public function handleErrors($exception)
    {
        $code = $exception->getCode();
        $content = $exception->getResponse()->getBody()->getContents();
        $response = json_decode($content);

        if (($code === 400 || $code === 422 || $code === 404) && $content !== "") {
            throw new \Wise\Exception\BadException($response->errors[0]->message, $code);
        }

        if ($code === 401 && $content !== "") {
            return [$response];
            throw new \Wise\Exception\AuthorisationException($response->message, $code);
        }

        throw new \Exception($exception->getMessage(), $code);
    }

}