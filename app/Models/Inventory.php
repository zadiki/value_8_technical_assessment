<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    //
    const INVENTORY_LOCATION_TYPE_BRANCH = 1;

    const INVENTORY_LOCATION_TYPE_SHOP = 2;

    const INVENTORY_LOCATION_TYPE_CENTRAL_WAREHOUSE = 3;
}
