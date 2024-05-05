<?php

namespace LesoWarehouseSystem\Repository;

use LesoWarehouseSystem\Factory\BrandFactory;

class BrandRepository extends AbstractRepository
{
    private BrandFactory $brandFactory;

    public function __construct(
        BrandFactory $brandFactory,
    ) {
        $this->brandFactory = $brandFactory;
    }

    private const BRAND_JSON_FILE = '../config/brands.json';
    private const COlUMN_NAME = 'brandName';
    private const COlUMN_QUALITY_CLASS = 'qualityClass';

    public function findAll(): array
    {
        $brands = [];
        $rawBrands = $this->getContent(self::BRAND_JSON_FILE);

        foreach ($rawBrands as $rawBrand) {
            $brands[] = $this->brandFactory->create(
                $rawBrand[self::COlUMN_NAME],
                $rawBrand[self::COlUMN_QUALITY_CLASS],
            );
        }

        return $brands;
    }
}