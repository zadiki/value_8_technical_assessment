<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lpo_number' => $this->lpo_number,
            'store_id' => $this->store_id,
            'branch_id' => $this->branch_id,
            'status' => $this->status,
            'user_name' => $this->name,
            'updated_at' => $this->updated_at,
            'store_name' => $this->store_name,
            'branch_name' => $this->branch_name,
            'ordered_by' => $this->ordered_by,
            'created_at' => $this->created_at->format('d-M-Y'),
            'order_type' => match (true) {
                $this->order_type == Order::ORDER_TYPE_SHOP_ORDER => 'Store Order',
                $this->order_type == Order::ORDER_TYPE_BRANCH_ORDER => 'Branch Order',
                $this->order_type == Order::ORDER_TYPE_CENTRAL_WAREHOUSE_ORDER => 'Central Warehouse Order',

            },
        ];
    }
}
