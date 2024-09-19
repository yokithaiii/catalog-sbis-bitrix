# Catalog SBIS to 1C-Bitrix Integration

<a href="https://github.com/ramsey/uuid/blob/4.x/LICENSE"><img src="https://img.shields.io/packagist/l/ramsey/uuid.svg?style=flat-square&colorB=darkcyan" alt="Read License"></a>

Эта библиотека интегрирует каталог из СБИС (Система Бизнес-Информации) с 1С-Битрикс (Управление сайтом). Она позволяет синхронизировать товары, категории и другие данные между СБИС и 1С-Битрикс, используя их REST API.

## Установка

Для установки библиотеки используйте Composer:

```bash
composer require yokithaii/catalog-sbis-bitrix
```

## Использование

### 1. Настройка авторизации

   Для работы с API СБИС и 1С-Битрикс вам нужно настроить авторизацию и получить токены доступа.

#### СБИС

Создайте экземпляр SbisAuthClient и передайте ему ваши учетные данные:

```php
use Yokithaii\CatalogSbisBitrix\Client\SbisAuthClient;

$sbisAuthClient = new SbisAuthClient(
    'your-sbis-app-client-id',
    'your-sbis-app-secret',
    'your-sbis-secret-key'
);
```

#### 1С-Битрикс

Создайте экземпляр BitrixAuthClient и передайте ему ваши учетные данные:

```php
use Yokithaii\CatalogSbisBitrix\Client\BitrixAuthClient;

$bitrixAuthClient = new BitrixAuthClient(
    'your-bitrix-client-id',
    'your-bitrix-client-secret',
    'your-bitrix-redirect-uri',
    'https://your-bitrix-site.ru/oauth/token/'
);
```

### 2. Создание клиентов API

Используйте полученные токены для создания клиентов API СБИС и 1С-Битрикс:

```php
use Yokithaii\CatalogSbisBitrix\Api\SbisApiClient;
use Yokithaii\CatalogSbisBitrix\Api\BitrixApiClient;

$sbisClient = new SbisApiClient($sbisAuthClient, 'https://api.sbis.ru');
$bitrixClient = new BitrixApiClient($bitrixAuthClient, 'https://your-bitrix-site.ru/rest/1/');
```

### 3. Синхронизация каталога

Создайте экземпляр CatalogIntegrator и вызовите метод syncCatalog для синхронизации данных:

```php
use Yokithaii\CatalogSbisBitrix\Service\CatalogIntegrator;

$integrator = new CatalogIntegrator($sbisClient, $bitrixClient);
$integrator->syncCatalog();
```

## Лицензия

Этот проект лицензирован под MIT License. Подробности смотрите в файле LICENSE.

Если у вас есть вопросы или предложения, пожалуйста, создайте issue на GitHub.