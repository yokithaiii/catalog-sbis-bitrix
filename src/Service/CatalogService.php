<?php

namespace Yokithaiii\CatalogSbisBitrix\Service;

use Yokithaiii\CatalogSbisBitrix\Client\Bitrix\BitrixApiClient;
use Yokithaiii\CatalogSbisBitrix\Client\Sbis\SbisApiClient;

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