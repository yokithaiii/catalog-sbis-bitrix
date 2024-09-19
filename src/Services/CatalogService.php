<?php

namespace Yokithaii\CatalogSbisBitrix\Services;

use Yokithaii\CatalogSbisBitrix\Api\BitrixApiClient;
use Yokithaii\CatalogSbisBitrix\Api\SbisApiClient;

class CatalogService
{
    private $sbisClient;
    private $bitrixClient;

    public function __construct(SbisApiClient $sbisClient, BitrixApiClient $bitrixClient)
    {
        $this->sbisClient = $sbisClient;
        $this->bitrixClient = $bitrixClient;
    }

    public function syncCatalog(): array
    {
        $catalogData = $this->sbisClient->getCatalogData();
        $items = [];
        foreach ($catalogData as $item) {
            $items[] = $this->bitrixClient->addItem($item);
        }

        return $items;
    }
}