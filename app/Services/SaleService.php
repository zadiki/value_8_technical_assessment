<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\SaleServiceInterface;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\SaleDetail;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SaleService implements SaleServiceInterface
{
    public function processSale($saleData)
    {
        // Logic to process a sale, including inventory management and payment processing
        DB::beginTransaction();

        try {
            $sale = Sale::create($saleData);

            foreach ($saleData['sale_details'] as $item) {

                $saleDetail = SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);

                // Update inventory logic here
                $inventory = Inventory::where('product_id', $item['product_id'])
                    ->where('store_id', $saleData['store_id'])
                    ->where('active_status', true)
                    ->where('location_type', Inventory::INVENTORY_LOCATION_TYPE_SHOP)->first();
                if (! $inventory || $inventory->quantity < $item['quantity']) {
                    throw new Exception('Insufficient inventory for product ID: '.$item['product_id']);
                }
                $inventoryRequested = $inventory->quantity;

                $affected = DB::table('inventory')
                    ->where('id', $inventory->id)
                    ->where('quantity', '>=', $inventoryRequested)
                    ->decrement('quantity', $item['quantity']);

                if (! $affected) {
                    throw new Exception('Insufficient inventory for product ID: '.$item['product_id']);
                }

                $inventory->save();
                InventoryService::createStockMovementAfterSale($saleDetail, $sale, $inventory);
            }
            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Sale processed successfully',
                'data' => $sale,
            ];
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getSalesReport()
    {
        // Logic to generate a sales report for the given date range
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;

        $report = ['total_sales_this_year' => 0, 'total_sales_this_month' => 0, 'total_sales_today' => 0];

        $totalSalesThisYear = DB::table('sales')
            ->select(DB::raw('SUM(total_amount) as total_sales'))
            ->where('year', $currentYear)
            ->first();

        $report['total_sales_this_year'] = $totalSalesThisYear ? $totalSalesThisYear->total_sales : 0;

        $totalSalesThisMonth = DB::table('sales')
            ->select(DB::raw('SUM(total_amount) as total_sales'))
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->first();
        $report['total_sales_this_month'] = $totalSalesThisMonth ? $totalSalesThisMonth->total_sales : 0;

        $totalSalesToday = DB::table('sales')
            ->select(DB::raw('SUM(total_amount) as total_sales'))
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->where('day', $currentDay)
            ->first();
        $report['total_sales_today'] = $totalSalesToday ? $totalSalesToday->total_sales : 0;

        return $report;
    }

    public function getStoreSalesReport($storeId, $startDate, $endDate)
    {
        // Logic to generate a sales report for a specific store and date range
        $reports = DB::table('sales')
            ->select('store_id', DB::raw('SUM(total_amount) as total_sales'))
            ->where('store_id', $storeId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('is_active', true)
            ->groupBy('store_id')
            ->get();

        return $reports;
    }

    public function getBranchSalesReport($branchId, $startDate, $endDate)
    {
        // Logic to generate a sales report for a specific branch and date range
        $reports = DB::table('sales')
            ->select('branch_id', DB::raw('SUM(total_amount) as total_sales'))
            ->where('branch_id', $branchId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('is_active', true)
            ->groupBy('branch_id')
            ->get();

        return $reports;
    }

    public function getDailySalesReport($datefrom, $dateto)
    {
        // Logic to generate a daily sales report for the given date
        $reports = DB::table('sales')
            ->select('year', 'month', 'day', DB::raw('SUM(total_amount) as total_sales'))
            ->whereBetween('created_at', [$datefrom, $dateto])
            ->where('is_active', true)
            ->groupBy('year', 'month', 'day')
            ->get();

        return $reports;
    }

    public function getSaleDetails($saleId)
    {
        // Logic to retrieve details of a specific sale
        $saledetails = SaleDetail::where('sale_id', $saleId)->get(); // Placeholder for sale details retrieval logic

        return $saledetails;
    }

    public function getSalesPerStore($storeId)
    {
        // Logic to retrieve sales data for a specific store
        $sales = Sale::where('store_id', $storeId)->get(); // Placeholder for sales retrieval logic

        return $sales;
    }
}
