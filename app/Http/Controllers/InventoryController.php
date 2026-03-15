<?php

namespace App\Http\Controllers;

use App\Interfaces\InventoryServiceInterface;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    private $inventoryService;

    public function __construct(InventoryServiceInterface $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function getAllStoreInventory(Request $request)
    {
        $validated = $request->validate(['store_id' => 'required|integer']);
        $this->authorize('viewStoreInventory', [Store::class, $request->store_id]);
        $storeId = $request->input('store_id');

        return $this->inventoryService->getAllStoreInventory($storeId);
    }

    public function getBranchInventory(Request $request)
    {
        $validated = $request->validate(['branch_id' => 'required|integer']);
        $this->authorize('viewBranchInventory', [Branch::class, $request->branch_id]);
        $branchId = $request->input('branch_id');

        return $this->inventoryService->getBranchInventory($branchId);
    }

    public function getActiveStoreInventory(Request $request)
    {
        $validated = $request->validate(['store_id' => 'required|integer']);
        $this->authorize('viewStoreInventory', [Store::class, $request->store_id]);
        $storeId = $request->input('store_id');

        return $this->inventoryService->getActiveStoreInventory($storeId);
    }

    public function getActiveBranchInventory(Request $request)
    {
        $validated = $request->validate(['branch_id' => 'required|integer']);
        $this->authorize('viewBranchInventory', [Branch::class, $request->branch_id]);
        $branchId = $request->input('branch_id');

        return $this->inventoryService->getActiveBranchInventory($branchId);
    }

    public function getAllCentralWarehouseInventory(Request $request)
    {
        $this->authorize('viewCentralWarehouseInventory', Inventory::class);

        return $this->inventoryService->getAllCentralWarehouseInventory();
    }
}
