<?php

namespace Yokithaiii\CatalogSbisBitrix\Client\Sbis;

use Yokithaiii\CatalogSbisBitrix\Exception\ApiException;

class SbisApiClient
{
    private $authClient;
    private $baseUrl;

    public function __construct(SbisAuthClient $authClient, $baseUrl)
    {
        $this->authClient = $authClient;
        $this->baseUrl = $baseUrl;
    }

    public function getProducts
    (
        $product,
        $pointId,
        $priceListId,
        $withBalance = true,
        $withBarcode = true,
        $onlyPublished = true,
        $page = 0,
        $pageSize = 50
    )
    {
        $accessToken = $this->authClient->getAccessToken();

        $url = $this->baseUrl . "/retail/nomenclature/list?product={$product}&pointId={$pointId}&priceListId={$priceListId}&withBalance={$withBalance}&withBarcode={$withBarcode}&onlypublished={$onlyPublished}&page={$page}&pageSize={$pageSize}";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => [
                "Content-type: charset=utf-8",
                "X-SBISAccessToken: {$accessToken}",
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new ApiException('Failed to get products.');
        }

        return json_decode($response, true);
    }
}