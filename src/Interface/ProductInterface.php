<?php

namespace Yokithaiii\CatalogSbisBitrix\Interface;

interface ProductInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getPrice(): float;

    public function getDescription(): string;

    public function setId(int $id): void;

    public function setName(string $name): void;

    public function setPrice(float $price): void;

    public function setDescription(string $description): void;

}