<?php

namespace LesoWarehouseSystem\Repository;

use LesoWarehouseSystem\Factory\WarehouseFactory;
use LesoWarehouseSystem\Model\Warehouse;

class WarehouseRepository extends AbstractRepository
{
    private const BRAND_JSON_FILE = '../config/warehouses.json';
    private const COlUMN_NAME = 'name';
    private const COlUMN_ADDRESS = 'address';
    private const COlUMN_CAPACITY = 'capacity';
    private WarehouseFactory $warehouseFactory;

    public function __construct(
        WarehouseFactory $warehouseFactory
    )
    {
        $this->warehouseFactory = $warehouseFactory;
    }

    /** @return Warehouse[] */
    public function findAll(): array
    {
        $brands = [];
        $rawWarehouses = $this->getContent(self::BRAND_JSON_FILE);

        foreach ($rawWarehouses as $rawWarehouse) {
            $brands[] = $this->warehouseFactory->create(
                $rawWarehouse[self::COlUMN_NAME],
                $rawWarehouse[self::COlUMN_ADDRESS],
                $rawWarehouse[self::COlUMN_CAPACITY],
            );
        }

        return $brands;
    }

    public function save(Warehouse $warehouse): Warehouse
    {
        //TODO: Save to the json file

        return $warehouse;
    }
}