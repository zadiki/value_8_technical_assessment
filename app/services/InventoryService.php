<?php

namespace App\Services;

use App\Interfaces\InventoryServiceInterface;

class InventoryService implements InventoryServiceInterface
{
    // Implementation for inventory management
    public function getAllShopInventory($shopId)
    {
        // Logic to retrieve inventory for a specific shop
        $shopInventory = Inventory::where('shop_id', $shopId)->paginate(50);

        return $shopInventory;
    }

    public function updateShopInventory($shopId, $inventoryData)
    {
        // Logic to update inventory for a specific shop
    }

    public function updateBranchInventory($branchId, $inventoryData)
    {
        // Logic to update inventory for a specific branch
    }

    public function getBranchInventory($branchId)
    {
        // Logic to retrieve inventory for a specific branch
        $branchInventory = Inventory::where('branch_id', $branchId)->paginate(50);

        return $branchInventory;
    }

    public function getActiveShopInventory($shopId)
    {
        $shopInventory = Inventory::where('shop_id', $shopId)
            ->where('location_type', Inventory::INVENTORY_LOCATION_TYPE_SHOP)
            ->where('is_active', true)->paginate(50);

        return $shopInventory;
    }

    public function getActiveBranchInventory($branchId)
    {
        $branchInventory = Inventory::where('branch_id', $branchId)
            ->where('location_type', Inventory::INVENTORY_LOCATION_TYPE_BRANCH)
            ->where('is_active', true)->paginate(50);

        return $branchInventory;
    }

    public function getAllCentralWarehouseInventory()
    {
        $centralWarehouseInventory = Inventory::where('location_type', Inventory::INVENTORY_LOCATION_TYPE_CENTRAL_WAREHOUSE)
            ->paginate(50);

        return $centralWarehouseInventory;
    }

    public function getActiveCentralWarehouseInventory()
    {
        $centralWarehouseInventory = Inventory::where('location_type', Inventory::INVENTORY_LOCATION_TYPE_CENTRAL_WAREHOUSE)
            ->where('is_active', true)->paginate(50);

        return $centralWarehouseInventory;
    }

    public static function createStockMovementAfterSale(Saledetail $saleDetail, Sale $sale, Inventory $inventory)
    {
        $stockMovement = new StockMovement;
        $stockMovement->shop_id = $sale->shop_id;
        $stockMovement->product_id = $saleDetail->product_id;
        $stockMovement->quantity_changed = -$saleDetail->quantity;
        $stockMovement->movement_type = StockMovement::MOVEMENT_TYPE_SALE;
        $stockMovement->save();
    }
}
