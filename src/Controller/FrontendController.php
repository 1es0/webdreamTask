<?php

namespace LesoWarehouseSystem\Controller;

use LesoWarehouseSystem\Exception\AllWareHousesFullException;
use LesoWarehouseSystem\Model\Brand;
use LesoWarehouseSystem\Model\Products\FoodProduct;
use LesoWarehouseSystem\Model\Warehouse;
use LesoWarehouseSystem\Service\WarehouseService;

class FrontendController
{
    public function index(): void
    {
        $warehouseService = new WarehouseService();

        $warehouses[] = new Warehouse(
            'Szentesi raktár',
            'Szentes',
            1
        );

        $warehouses[] = new Warehouse(
            'Békési raktár',
            'Békés',
            3
        );

        $brandKifli = new Brand('KifliBrand', 3);

        $products[] = new FoodProduct(
            'Food1',
            'Kifli',
            140,
            $brandKifli
        );

        $products[] = new FoodProduct(
            'Food2',
            'Kifli',
            140,
            $brandKifli
        );

        $products[] = new FoodProduct(
            'Food3',
            'Kifli',
            140,
            $brandKifli
        );

        $products[] = new FoodProduct(
            'Food4',
            'Kifli',
            140,
            $brandKifli
        );

        $products[] = new FoodProduct(
            'Food5',
            'Kifli',
            140,
            $brandKifli
        );

        try {
            $warehouseService->addProductsToWarehouses(
                $products,
                $warehouses
            );
        } catch (AllWareHousesFullException $e) {
            print 'Az összes raktár tele van!<br />';
        }

        $products = $warehouseService->listAllItemsFromAllWarehouses(
            $warehouses,
        );

        print 'A raktárak tartalma: <br />';

        foreach ($products as $product) {
            print sprintf('A termék: %s  <br />', $product->getItemNumber());
        }

        $products_remove[] = new FoodProduct(
            'Food1',
            'Kifli',
            140,
            $brandKifli
        );

        $products_remove[] = new FoodProduct(
            'Food2',
            'Kifli',
            140,
            $brandKifli
        );

        $warehouseService->removeProductsFromWarehouses(
            $products_remove,
            $warehouses,
        );

        $products = $warehouseService->listAllItemsFromAllWarehouses(
            $warehouses,
        );

        print '<br />A raktárak tartalma a termék elvétele után: <br />';

        foreach ($products as $product) {
            print sprintf('A termék: %s  <br />', $product->getItemNumber());
        }
    }
}