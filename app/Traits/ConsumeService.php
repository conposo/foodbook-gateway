<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

trait ConsumeService
{
    public function performRequest($method, $requestUri, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        try {
            // dd($formParams);
            $response = $client->request($method, $requestUri, ['form_params' => $formParams, 'headers' => $headers]);
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