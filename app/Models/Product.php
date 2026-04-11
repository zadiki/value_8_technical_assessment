<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_type',
        'product_code',
        'bar_code',
        'market_unit_cost',
        'brand',
        'manufacturer',
    ];
}
