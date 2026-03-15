<?php

namespace App\Interfaces;

interface StoreServiceInterface
{
    public function createStore($storeData);

    public function getStoreDetails($storeId);

    public function updateStore($storeId, $storeData);

    public function deleteStore($storeId);
}
