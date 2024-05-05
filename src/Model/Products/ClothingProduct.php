<?php

namespace LesoWarehouseSystem\Model\Products;

use LesoWarehouseSystem\Model\Product;

class ClothingProduct extends Product
{
    private string $size;

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }
}