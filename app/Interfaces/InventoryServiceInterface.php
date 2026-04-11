<?php

declare(strict_types=1);

namespace App\Interfaces;

interface InventoryServiceInterface
{
    public function getAllStoreInventory($storeId);

    public function updateStoreInventory($storeId, $inventoryData);

    public function updateBranchInventory($branchId, $inventoryData);

    public function getBranchInventory($branchId);

    public function getActiveStoreInventory($storeId);

    public function getActiveBranchInventory($branchId);

    public function getAllCentralWarehouseInventory();

    public function getActiveCentralWarehouseInventory();
}
