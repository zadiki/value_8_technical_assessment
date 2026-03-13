<?php

namespace App\Http\Controllers;

use App\Interfaces\DeliveryNoteServiceInterface;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{
    //
    private $deliveryNoteService;
    public function __construct(DeliveryNoteServiceInterface $deliveryNoteService)
    {
        $this->deliveryNoteService = $deliveryNoteService;
    }
}
