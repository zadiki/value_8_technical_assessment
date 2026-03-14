<?php

namespace App\Interfaces;

interface SaleServiceInterface
{
    public function processSale($saleData);

    public function getSalesReport($startDate, $endDate);

    public function getSaleDetails($saleId);

    public function getSalesPerShop($shopId);
}
