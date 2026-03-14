<?php

namespace App\Interfaces;

interface SaleServiceInterface
{
    public function processSale($saleData);

    public function getSalesReport();

    public function getSaleDetails($saleId);

    public function getSalesPerShop($shopId);

    public function getShopSalesReport($shopId, $startDate, $endDate);

    public function getBranchSalesReport($branchId, $startDate, $endDate);

    public function getDailySalesReport($datefrom, $dateto);
}
