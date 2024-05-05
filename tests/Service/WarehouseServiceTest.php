<?php

namespace Service;

use LesoWarehouseSystem\Service\WarehouseService;
use PHPUnit\Framework\TestCase;

class WarehouseServiceTest extends TestCase
{
    private WarehouseService $sut;

    protected function setUp(): void {
        $this->sut = new WarehouseService();
    }


    public function testStoreItems() {

    }
}