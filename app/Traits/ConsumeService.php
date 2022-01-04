<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

trait ConsumeService
{
    public function performRequest($method, $requestUri, $data = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        try {
            $response = $client->request($method, $requestUri, ['form_params' => $data, 'headers' => $headers]);
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            // echo( Psr7\str($e->getRequest()) );
            // if ($e->hasResponse()) {
            //     echo Psr7\str($e->getResponse());
            // }
            return '[]';
        }

    }
}