<?php

namespace LesoWarehouseSystem\Service;

use LesoWarehouseSystem\Exception\AllWareHousesFullException;
use LesoWarehouseSystem\Exception\WareHouseFullException;
use LesoWarehouseSystem\Factory\WarehouseFactory;
use LesoWarehouseSystem\Model\Product;
use LesoWarehouseSystem\Model\Warehouse;
use LesoWarehouseSystem\Repository\WarehouseRepository;

class WarehouseService
{
    private WarehouseRepository $warehouseRepository;
    private WarehouseFactory $warehouseFactory;

    public function __construct(
        WarehouseRepository $warehouseRepository,
        WarehouseFactory $warehouseFactory
    ) {
        $this->warehouseRepository = $warehouseRepository;
        $this->warehouseFactory = $warehouseFactory;
    }

    public function createWarehouse(
        string $name,
        string $address,
        int $capacity
    ): Warehouse {
        $warehouse = $this->warehouseFactory->create(
            $name,
            $address,
            $capacity
        );

        $this->warehouseRepository->save($warehouse);
    }

    public function listAllItemsFromAllWarehouses(): array
    {
        $warehouses = $this->warehouseRepository->findAll();
        $items = [];

        foreach ($warehouses as $warehouse) {
            $items[] = $warehouse->getAllProducts();
        }

        return $items;
    }

    /**
     * @param array $products
     * @throws AllWareHousesFullException
     */
    public function addProductsToWarehouses(array $products): bool
    {
        $warehouses = $this->warehouseRepository->findAll();

        foreach ($products as $product) {
            $this->addOneProductToAvailableWarehouse(
                $product,
                $warehouses
            );
        }
    }

    public function removeProductsFromWarehouses(array $products): bool
    {
        $warehouses = $this->warehouseRepository->findAll();

        foreach ($products as $product) {
            $this->removeOneProductFromAvailableWarehouse(
                $product,
                $warehouses
            );
        }
    }

    /**
     * @param Warehouse[] $warehouses
     * @throws AllWareHousesFullException
     */
    private function addOneProductToAvailableWarehouse(
        Product $product,
        array $warehouses
    ): void {
        foreach ($warehouses as $warehouse) {
            try {
                $warehouse->addItem($product);

                return;
            } catch (WareHouseFullException) {
                break;
            }
        }

        throw new AllWareHousesFullException();
    }

    /** @param  Warehouse[] $warehouses */
    private function removeOneProductFromAvailableWarehouse(Product $product, array $warehouses): bool
    {
        foreach ($warehouses as $warehouse) {
            $warehouseProducts = $warehouse->getAllProducts();

            foreach ($warehouseProducts as $warehouseProduct) {
                if ($product->getItemNumber() === $warehouseProduct->getItemNumber()) {
                    $warehouse->removeItem($warehouseProduct);

                    return true;
                }
            }
        }

        return false;
    }
}