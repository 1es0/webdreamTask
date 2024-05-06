<?php

namespace LesoWarehouseSystem\Service;

use LesoWarehouseSystem\Exception\AllWareHousesFullException;
use LesoWarehouseSystem\Exception\TooFewProductsException;
use LesoWarehouseSystem\Exception\WareHouseFullException;
use LesoWarehouseSystem\Model\Product;
use LesoWarehouseSystem\Model\Warehouse;


class WarehouseService
{
    /**
     * @param Warehouse[] $warehouses
     * @return Product[]
     */
    public function listAllItemsFromAllWarehouses(
        array $warehouses
    ): array {
        $items = [];

        foreach ($warehouses as $warehouse) {
            $items = array_merge($items, $warehouse->getAllProducts());
        }

        return $items;
    }

    /**
     * @param array $products
     * @param Warehouse[] $warehouses
     * @throws AllWareHousesFullException
     */
    public function addProductsToWarehouses(
        array $products,
        array $warehouses
    ): void {
        foreach ($products as $product) {
            $this->addOneProductToAvailableWarehouse(
                $product,
                $warehouses
            );
        }
    }

    /**
     * @param Warehouse[] $warehouses
     * @param Product[] $products
     * @throws TooFewProductsException
     */
    public function removeProductsFromWarehouses(
        array $products,
        array $warehouses
    ): void {
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
                continue;
            }
        }

        throw new AllWareHousesFullException();
    }

    /**
     * @param Warehouse[] $warehouses
     * @throws TooFewProductsException
     */
    private function removeOneProductFromAvailableWarehouse(
        Product $product,
        array $warehouses
    ): void {
        foreach ($warehouses as $warehouse) {
            $warehouseProducts = $warehouse->getAllProducts();

            foreach ($warehouseProducts as $warehouseProduct) {
                if ($product->getItemNumber() === $warehouseProduct->getItemNumber()) {
                    $warehouse->removeItem($warehouseProduct);

                    return;
                }
            }
        }

        throw new TooFewProductsException();
    }
}