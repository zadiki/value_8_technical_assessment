<?php

namespace App\Interfaces;

interface InventoryServiceInterface
{
    public function getAllShopInventory($shopId);

    public function updateShopInventory($shopId, $inventoryData);

    public function updateBranchInventory($branchId, $inventoryData);

    public function getBranchInventory($branchId);

    public function getActiveShopInventory($shopId);

    public function getActiveBranchInventory($branchId);

    public function getAllCentralWarehouseInventory();

    public function getActiveCentralWarehouseInventory();
}
