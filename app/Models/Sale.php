<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Sale extends Model
{
    use HasFactory;
    //

    const SALE_TYPE_CASH = 0;

    const SALE_TYPE_CREDIT = 1;

    const PAYMENT_METHOD_CASH = 0;

    const PAYMENT_METHOD_MPESA = 1;

    const PAYMENT_METHOD_CARD = 2;

    const PAYMENT_METHOD_BANK = 3;

    const PAYMENT_STATUS_PENDING = 0;

    const PAYMENT_STATUS_PAID = 1;

    const PAYMENT_STATUS_PARTIAL_PAID = 2;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {

            $sale->year = Carbon::now()->year;
            $sale->month = Carbon::now()->month;
            $sale->day = Carbon::now()->day;
        });
    }
}
