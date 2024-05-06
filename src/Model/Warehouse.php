<?php

namespace LesoWarehouseSystem\Model;

use LesoWarehouseSystem\Exception\WareHouseFullException;

class Warehouse
{
    private string $name;
    private string $address;
    private int $capacity;

    /** @var Product[] */
    private array $products = [];

    public function __construct(
        string $name,
        string $address,
        int $capacity
    ) {
        $this->capacity = $capacity;
        $this->address = $address;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getFreeCapacity(): int
    {
        return $this->capacity - $this->countProducts();
    }

    /**
     * @throws WareHouseFullException
     */
    public function addItem(Product $product): void
    {
        if ($this->warehouseIsFull()) {
            throw new WareHouseFullException;
        }

        $this->products[] = $product;
    }

    public function removeItem(Product $product): void
    {
        foreach ($this->products as $index => $warehouseProduct) {
            if ($warehouseProduct->getItemNumber() === $product->getItemNumber()) {
                array_splice($this->products, $index, 1);

                return;
            }
        }
    }

    /**
     * @return Product[]
     */
    public function getAllProducts(): array
    {
        return $this->products;
    }

    private function warehouseIsFull(): int
    {
        return ($this->capacity <= $this->countProducts());
    }

    private function countProducts(): int
    {
        return count($this->products);
    }
}