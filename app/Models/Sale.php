<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    //

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
