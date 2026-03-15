<?php

namespace App\Services;

use App\Interfaces\InventoryServiceInterface;

class InventoryService implements InventoryServiceInterface
{
    // Implementation for inventory management
    public function getAllStoreInventory($storeId)
    {
        // Logic to retrieve inventory for a specific store
        $storeInventory = Inventory::where('store_id', $storeId)->paginate(50);

        return $storeInventory;
    }

    public function updateStoreInventory($storeId, $inventoryData)
    {
        // Logic to update inventory for a specific store
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

    public function getActiveStoreInventory($storeId)
    {
        $storeInventory = Inventory::where('store_id', $storeId)
            ->where('location_type', Inventory::INVENTORY_LOCATION_TYPE_SHOP)
            ->where('is_active', true)->paginate(50);

        return $storeInventory;
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
        $stockMovement->store_id = $sale->store_id;
        $stockMovement->product_id = $saleDetail->product_id;
        $stockMovement->quantity_changed = -$saleDetail->quantity;
        $stockMovement->transaction_type = StockMovement::TRANSACTION_TYPE_OUT;
        $stockMovement->reference_type = StockMovement::REFERENCE_TYPE_SALE_OUT;
        $stockMovement->reference_id = $saleDetail->id;
        $stockMovement->approval_status = StockMovement::APPROVAL_STATUS_APPROVED;
        $stockMovement->created_by = $sale->created_by;
        $stockMovement->save();
    }
}
