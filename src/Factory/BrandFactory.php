<?php

namespace LesoWarehouseSystem\Factory;

use LesoWarehouseSystem\Model\Brand;
use LesoWarehouseSystem\Repository\BrandRepository;

class BrandFactory
{
    public function create(
        string $brandName,
        int $qualityClass
    ): Brand {
       return new Brand($brandName, $qualityClass);
    }
}