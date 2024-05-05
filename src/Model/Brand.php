<?php

namespace LesoWarehouseSystem\Model;

class Brand
{
    private string $brandName;
    private int $qualityClass;

    public function __construct(
        string $brandName,
        int $qualityClass,
    ) {
        $this->brandName = $brandName;
        $this->qualityClass = $qualityClass;
    }
}