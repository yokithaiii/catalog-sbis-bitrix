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
        $pointId,
        $priceListId,
        $withBalance = true,
        $page = 0,
        $pageSize = 50
    )
    {
        $accessToken = $this->authClient->getAccessToken();

        $url = $this->baseUrl . "/retail/nomenclature/list?";
        $url .= "pointId={$pointId}&priceListId={$priceListId}&withBalance={$withBalance}&page={$page}&pageSize={$pageSize}";

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

    public function getSalePoints
    (
        $pointId,
        $page = 0,
        $pageSize = 50
    )
    {
        $accessToken = $this->authClient->getAccessToken();

        $url = $this->baseUrl . "/retail/point/list?";
        $url .= "pointId={$pointId}&page={$page}&pageSize={$pageSize}";

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

    public function getPriceLists
    (
        $pointId,
        $actualDate,
        $page = 0,
        $pageSize = 50
    )
    {
        $accessToken = $this->authClient->getAccessToken();

        $url = $this->baseUrl . "/retail/nomenclature/price-list?";
        $url .= "pointId={$pointId}&actualDate={$actualDate}&page={$page}&pageSize={$pageSize}";

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