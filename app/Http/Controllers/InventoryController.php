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

    public function getAllShopInventory(Request $request)
    {
        $validated = $request->validate(['shop_id' => 'required|integer']);
        $this->authorize('viewShopInventory', [Shop::class, $request->shop_id]);
        $shopId = $request->input('shop_id');

        return $this->inventoryService->getAllShopInventory($shopId);
    }

    public function getBranchInventory(Request $request)
    {
        $validated = $request->validate(['branch_id' => 'required|integer']);
        $this->authorize('viewBranchInventory', [Branch::class, $request->branch_id]);
        $branchId = $request->input('branch_id');

        return $this->inventoryService->getBranchInventory($branchId);
    }

    public function getActiveShopInventory(Request $request)
    {
        $validated = $request->validate(['shop_id' => 'required|integer']);
        $this->authorize('viewShopInventory', [Shop::class, $request->shop_id]);
        $shopId = $request->input('shop_id');

        return $this->inventoryService->getActiveShopInventory($shopId);
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
