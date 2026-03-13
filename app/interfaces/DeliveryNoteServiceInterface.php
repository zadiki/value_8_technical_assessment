<?php

namespace App\Interfaces;

interface DeliveryNoteServiceInterface
{
    public function createDeliveryNote($deliveryData);
    public function getDeliveryNoteDetails($deliveryId);
    public function updateDeliveryNote($deliveryId, $deliveryData);
    public function deleteDeliveryNote($deliveryId);
}
