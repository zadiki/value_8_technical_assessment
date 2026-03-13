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
}
