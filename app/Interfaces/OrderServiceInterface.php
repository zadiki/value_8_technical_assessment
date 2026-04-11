<?php

declare(strict_types=1);

namespace App\Interfaces;

interface OrderServiceInterface
{
    public function createOrder($orderData);

    public function getOrderDetails($orderId);

    public function updateOrderStatus($orderId, $status);

    public function cancelOrder($orderId);

    public function createOrderDetails($orderId, $orderDetailsData);

    public function updateOrderDetails($orderId, $orderDetailsData);

    public function deleteOrderDetails($orderId, $orderDetailsId);

    public function deleteOrder($orderId);

    public function approveOrder($orderId);

    public function getallOrders();
}
