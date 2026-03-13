<?php

namespace App\Interfaces;

interface OrderServiceInterface
{
    public function createOrder($orderData);
    public function getOrderDetails($orderId);
    public function updateOrderStatus($orderId, $status);
    public function cancelOrder($orderId);
}
