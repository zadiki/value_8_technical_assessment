<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DeliveryNoteServiceInterface;
use App\Models\DeliveryNote;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Gate;

class DeliveryNoteService implements DeliveryNoteServiceInterface
{
    public function createDeliveryNote($data)
    {
        // Logic to create a delivery note
        // This is a placeholder implementation
        return [
            'status' => 'success',
            'message' => 'Delivery note created successfully',
            'data' => $data,
        ];
    }

    public function getDeliveryNoteById($id)
    {
        // Logic to retrieve a delivery note by ID
        // This is a placeholder implementation
        return [
            'status' => 'success',
            'message' => 'Delivery note retrieved successfully',
            'data' => [
                'id' => $id,
                'customer_name' => 'John Doe',
                'items' => [
                    ['name' => 'Item 1', 'quantity' => 2],
                    ['name' => 'Item 2', 'quantity' => 1],
                ],
                'total_price' => 100.00,
            ],
        ];
    }

    public function getDeliveryNoteDetails($deliveryId)
    {
        return OrderDetail::with('product')->where('delivery_note_id', $deliveryId)->get();
    }

    public function updateDeliveryNote($deliveryId, $deliveryData)
    {
        $deliveryNote = DeliveryNote::findOrFail($deliveryId);

        Gate::authorize('editDeliveryNote', $deliveryNote);

        $deliveryNote->update($deliveryData);

        return [
            'status' => 'success',
            'message' => 'Delivery note updated successfully',
            'data' => $deliveryNote,
        ];
    }

    public function deleteDeliveryNote($deliveryId)
    {
        $deliveryNote = DeliveryNote::findOrFail($deliveryId);
        $deliveryNote->delete();
    }
}
