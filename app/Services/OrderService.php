<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderService implements OrderServiceInterface
{
    // Implementation for order creation
    public function createOrder($orderData)
    {
        if (! empty($orderData['store_id'])) {
            $store = Store::firstOrFail($orderData['store_id']);
            $recentOrder = Order::where('store_id', $store->id)->latest('id');
            $nextLpoNumber = 1;
            if ($recentOrder) {
                $nextLpoNumber = end(explode('-', $recentOrder->lpo_number)) + 1;
            }

            $orderData['lpo_number'] = NumberGenerator::generateLpoNumber($nextLpoNumber, $store->store_code);

        } elseif (! empty($orderData['branch_id'])) {
            $branch = Branch::firstOrFail($orderData['branch_id']);
            $recentOrder = Order::where('branch_id', $branch->id)->latest('id');
            $nextLpoNumber = 1;
            if ($recentOrder) {
                $nextLpoNumber = end(explode('-', $recentOrder->lpo_number)) + 1;
            }

            $orderData['lpo_number'] = NumberGenerator::generateLpoNumber($nextLpoNumber, $branch->branch_code);

        }
        // Logic to create a new order
        $order = Order::create($orderData);

        return $order;
    }

    public function getOrderDetails($orderId)
    {        // Logic to retrieve details of a specific order
        $order = Order::find($orderId);

        return $order;
    }

    public function updateOrderStatus($orderId, $status)
    {        // Logic to update the status of a specific order
        $order = Order::find($orderId);
        $order->update(['status' => $status]);

        return $order;
    }

    public function cancelOrder($orderId)
    {        // Logic to cancel a specific order
        $order = Order::find($orderId);
        $order->update(['status' => Order::STATUS_CANCELLED]);

        return $order;
    }

    public function createOrderDetails($orderId, $orderDetailsData)
    {

        // Logic to create order details for a specific order
        foreach ($orderDetailsData as $detailData) {
            $detailData['order_id'] = $orderId;
            OrderDetail::create($detailData);
        }

        return OrderDetail::where('order_id', $orderId)->get();
    }

    public function getAllOrders()
    {
        $orders = Order::query()
            ->leftJoin('stores', 'orders.store_id', '=', 'stores.id')
            ->leftJoin('branches', 'orders.branch_id', '=', 'branches.id')
            ->leftJoin('users', 'orders.ordered_by', '=', 'users.id')
            ->select([
                'orders.*',
                'stores.name as store_name',
                'branches.name as branch_name',
                'users.name',
            ])
            ->where('orders.status', 1)
            ->paginate(40);

        return OrderResource::collection($orders);
    }

    public function updateOrderDetails($orderId, $orderDetailsData)
    {
        // Logic to update order details for a specific order
        foreach ($orderDetailsData as $detailData) {
            $detail = OrderDetail::find($detailData['id']);
            $detail->update($detailData);
        }

        return OrderDetail::where('order_id', $orderId)->get();
    }

    public function deleteOrderDetails($orderId, $orderDetailsId)
    {        // Logic to delete order details for a specific order
        $orderDetails = OrderDetail::where('order_id', $orderId)->get();
        $orderDetails->delete();

        return $orderDetails;
    }

    public function deleteOrder($orderId)
    {        // Logic to delete a specific order
        $order = Order::find($orderId);
        $order->delete();

        return $order;
    }

    public function approveOrder($orderId) {}
}
