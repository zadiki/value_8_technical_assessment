<?php

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderService implements OrderServiceInterface
{
    // Implementation for order management
    public function createOrder($orderData)
    {
        if (
            $orderData['shop_id']
        ) {
            $shop = Shop::findOrFail($orderData['shop_id']);
            $recentOrder = Order::where('shop_id', $shop->id)->latest('id');
            $nextLpoNumber = 1;
            if ($recentOrder) {
                $nextLpoNumber = end(explode('-', $recentOrder->lpo_number)) + 1;
            }

            $orderData['lpo_number'] = NumberGenerator::generateLpoNumber($nextLpoNumber, $shop->shop_code);

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
}
