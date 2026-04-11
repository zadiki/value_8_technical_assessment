<?php

declare(strict_types=1);

namespace App\Interfaces;

interface SaleServiceInterface
{
    public function processSale($saleData);

    public function getSalesReport();

    public function getSaleDetails($saleId);

    public function getSalesPerStore($storeId);

    public function getStoreSalesReport($storeId, $startDate, $endDate);

    public function getBranchSalesReport($branchId, $startDate, $endDate);

    public function getDailySalesReport($datefrom, $dateto);
}
