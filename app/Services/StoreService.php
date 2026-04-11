<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\StoreServiceInterface;

class StoreService implements StoreServiceInterface
{
    // Implementation for store management
    public function createStore($storeData)
    {
        // Logic to create a new store
        $store = Store::create($storeData);

        return $store;
    }

    public function getStoreDetails($storeId)
    {        // Logic to retrieve details of a specific store
        $store = Store::find($storeId);

        return $store;
    }

    public function updateStore($storeId, $storeData)
    {        // Logic to update details of a specific store
        $store = Store::find($storeId);
        $store->update($storeData);

        return $store;
    }

    public function deleteStore($storeId)
    {        // Logic to delete a specific store
        $store = Store::find($storeId);
        $store->delete();

        return $store;
    }
}
