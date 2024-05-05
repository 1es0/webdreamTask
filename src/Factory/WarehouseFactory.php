<?php

namespace LesoWarehouseSystem\Factory;

use LesoWarehouseSystem\Model\Warehouse;

class WarehouseFactory
{
    public function create(
        string $name,
        string $address,
        int $capacity
    ): Warehouse {
        return new Warehouse(
            $name,
            $address,
            $capacity
        );
    }
}