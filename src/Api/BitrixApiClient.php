<?php

namespace Yokithaii\CatalogSbisBitrix\Api;

use http\Client\Response;

class BitrixApiClient
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    public function addItem($data): Response
    {
        $response = $this->makeRequest('/catalog/item/add', $data);

        return $response;
    }

    private function makeRequest($endpoint, $data): Response
    {
        // todo: make request to $endpoint
        // todo: return response
    }
}