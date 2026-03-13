<?php

namespace App\Interfaces;


interface InventoryServiceInterface
{
    public function getShopInventory($shopId);
    public function updateShopInventory($shopId, $inventoryData);
    public function updateBranchInventory($branchId, $inventoryData);
    public function getBranchInventory($branchId);
}
