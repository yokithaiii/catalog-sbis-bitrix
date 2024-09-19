<?php

namespace Yokithaii\CatalogSbisBitrix\Api;

use http\Client\Response;

class SbisApiClient
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    public function getCatalogData(): Response
    {
        $response = $this->makeRequest('/catalog');

        return $response;
    }

    private function makeRequest($endpoint): Response
    {
        // todo: make request to $endpoint
        // todo: return response
    }
}