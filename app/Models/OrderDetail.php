<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetail extends Model
{
    use HasFactory;
    //

    public function deliveryNote(): BelongsTo
    {
        return $this->belongsTo(DeliveryNote::class);
    }

    /**
     * Get the branch associated with the user (as a manager).
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class);
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
