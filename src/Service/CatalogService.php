<?php

namespace Yokithaii\CatalogSbisBitrix\Service;

use Yokithaii\CatalogSbisBitrix\Client\Bitrix\BitrixApiClient;
use Yokithaii\CatalogSbisBitrix\Client\Sbis\SbisApiClient;

class CatalogService
{
    private $sbis;
    private $bitrix;

    public function __construct(SbisApiClient $sbis, BitrixApiClient $bitrix)
    {
        $this->sbis = $sbis;
        $this->bitrix = $bitrix;
    }

    public function syncCatalog()
    {
        //
    }
}