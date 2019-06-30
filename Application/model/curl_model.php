<?php

require "../vendor/autoload.php";

class Curl_Model
{

    private $http_client;
    protected $response;
    protected $status_code;

    /**
     * Curl_Model constructor.
     * Set up an instance of the Guzzle Http Client [https://packagist.org/packages/guzzlehttp/guzzle]
     * for CURL requests
     */
    function __construct()
    {
        $this->http_client = new \GuzzleHttp\Client();
    }


    public function find_all()
    {

        try {

           

                $this->response = $this->http_client->request('GET', "http://localhost/capify/rest_api/api/file/all.php",
                    [
                        'verify' => false
                    ]);
                    

            $this->status_code = $this->response->getStatusCode();
            return json_decode($this->response->getBody());

        } catch (Exception $e) {

            // echo "Exception: " . $e;

        }

    }

    public function find_record($payload)
    {

        try {


                $this->response = $this->http_client->request('GET', "http://localhost/capify/rest_api/api/file/show.php",
                    [
                        'query' => [
                            'id' => 1
                        ],
                        'verify' => false
                    ]);
                    

            $this->status_code = $this->response->getStatusCode();
            return $this->response->getBody();

        } catch (Exception $e) {

            // echo "Exception: " . $e;

        }


    }


    public function store($payload)
    {


        try {


                $this->response = $this->http_client->request('POST', "http://localhost/capify/rest_api/api/file/create.php",[
                    'json' => [
                        'name' => $payload['name'],
                        'extension' => $payload['extension'],
                        'mime_type' => $payload['mime_type'],
                        'size' => $payload['size'],
                        'md5' => $payload['md5'],
                        'dimensions' => $payload['dimensions']['width']. " / " . $payload['dimensions']['height']
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ]

                    ]
            );
                    

            $this->status_code = $this->response->getStatusCode();
            return $this->response->getBody();

        } catch (Exception $e) {

            echo "<pre>";
             echo "Exception: " . $e;
             echo "</pre>";

        }




    }



}