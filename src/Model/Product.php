<?php

namespace Yokithaii\CatalogSbisBitrix\Model;

use Yokithaii\CatalogSbisBitrix\Interface\ProductInterface;

class Product implements ProductInterface
{
    private $id;
    private $name;
    private $price;
    private $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}