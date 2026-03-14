<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //
    const STATUS_CREATED = 0;

    const STATUS_CONFIRMED = 1;

    const STATUS_CANCELLED = 2;

    const STATUS_DISPATCHED = 3;

    const STATUS_DELIVERED = 4;
}
