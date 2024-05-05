<?php

namespace LesoWarehouseSystem\Model\Products;

use DateTime;
use LesoWarehouseSystem\Model\Product;

class FoodProduct extends Product
{
    private DateTime $expirationDate;

    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(DateTime $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }
}