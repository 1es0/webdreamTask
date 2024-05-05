<?php

namespace LesoWarehouseSystem\Model;

abstract class Product
{
    private string $itemNumber;
    private string $description;
    private float $price;
    private Brand $brand;

    public function __construct(
        string $itemNumber,
        string $description,
        float $price,
        Brand $brand,
    ) {
        $this->itemNumber = $itemNumber;
        $this->description = $description;
        $this->price = $price;
        $this->brand = $brand;
    }

    public function getItemNumber(): string
    {
        return $this->itemNumber;
    }
}