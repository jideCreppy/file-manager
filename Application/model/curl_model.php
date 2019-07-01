<?php

require "../vendor/autoload.php";

class Curl_Model
{


    private $http_client;
    protected $response;
    protected $status_code;


    function __construct()
    {

        $this->http_client = new \GuzzleHttp\Client();

    }


    /**
     * API GET request to fetch all files
     * @return mixed JSON API response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find_all()
    {

        try {
            $this->response = $this->http_client->request('GET',
                "http://{$_SERVER['REMOTE_ADDR']}:9000/api/file/all.php",
                [
                    'verify' => false
                ]);
            $this->status_code = $this->response->getStatusCode();
            return json_decode($this->response->getBody());

        } catch (Exception $e) {
            // echo "Exception: " . $e;
        }

    }


    /**
     * API POST request to save a new database record
     * @param $payload Data to be sent via POST
     * @return Guzzle HTTP object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store($payload)
    {

        try {
            $this->response = $this->http_client->request('POST',
                "http://{$_SERVER['REMOTE_ADDR']}:9000/api/file/create.php", [
                    'json' => [
                        'name' => $payload['name'],
                        'extension' => $payload['extension'],
                        'mime_type' => $payload['mime_type'],
                        'size' => $payload['size'],
                        'md5' => $payload['md5'],
                        'dimensions' => $payload['dimensions']['width'] . " / " .
                            $payload['dimensions']['height']
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'verify' => false
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


    /**
     * API POST request to delete a single record
     * This method uses 'X-HTTP-Method-Override' to override
     * method as DELETE
     * @param $id Record ID
     * @return Guzzle HTTP object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy($id)
    {

        try {
            $this->response = $this->http_client->request('POST',
                "http://{$_SERVER['REMOTE_ADDR']}:9000/api/file/delete.php",
                [
                    'json' => [
                        'id' => $id,
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-HTTP-Method-Override' => "DELETE"
                    ],
                    'verify' => false,
                ]);

            $this->status_code = $this->response->getStatusCode();
            return $this->response->getBody();

        } catch (Exception $e) {
            echo "Exception: " . $e;
        }

    }

}