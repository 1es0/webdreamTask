<?php

namespace LesoWarehouseSystem\Controller;

use LesoWarehouseSystem\Repository\BrandRepository;

class FrontendController
{
    private BrandRepository $brandRepository;

    public function __construct(
        BrandRepository $brandRepository
    ) {
        $this->brandRepository = $brandRepository;
    }

    public function index(): void
    {
        var_dump($this->brandRepository->findAll());
        print 'test';
    }
}