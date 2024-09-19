<?php

namespace Yokithaiii\CatalogSbisBitrix\Client\Bitrix;

use Yokithaiii\CatalogSbisBitrix\Exception\ApiException;

class BitrixApiClient
{
    private $authClient;
    private $baseUrl;

    public function __construct(BitrixAuthClient $authClient, $baseUrl)
    {
        $this->authClient = $authClient;
        $this->baseUrl = $baseUrl;
    }

    public function addProduct($productData)
    {
        $accessToken = $this->authClient->getAccessToken();

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->baseUrl . '/catalog/product/add',
            CURLOPT_POST => true,
            CURLOPT_HEADER => 0,
            CURLOPT_POSTFIELDS => json_encode($productData),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $accessToken,
                'Content-type: application/json'
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new ApiException('Failed to add product.', $httpCode);
        }

        return json_decode($response, true);
    }
}