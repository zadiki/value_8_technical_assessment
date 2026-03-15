<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    //

    public function createOrder(Request $request)
    {
        $orderData = $request->validate([
            'store_id' => 'integer',
            'branch_id' => 'integer',
        ]);

        return $this->orderService->createOrder($orderData);
    }

    public function getallOrders(Request $request)
    {

        return $this->orderService->getAllOrders();
    }
}
