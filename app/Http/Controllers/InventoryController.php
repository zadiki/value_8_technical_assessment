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
    public function getShopInventory(Request $request)
    {
        $validated = $request->validate(['shop_id' => 'required|integer']);

        $shopId = $request->input('shop_id');
        return $this->inventoryService->getShopInventory($shopId);
    }
    public function getBranchInventory(Request $request)
    {
        $validated = $request->validate(['branch_id' => 'required|integer']);

        $branchId = $request->input('branch_id');
        return $this->inventoryService->getBranchInventory($branchId);
    }
}
