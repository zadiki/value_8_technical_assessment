<?php

namespace App\Services;

use App\Interfaces\ShopServiceInterface;

class ShopService implements ShopServiceInterface
{
    // Implementation for shop management
    public function createShop($shopData)
    {
        // Logic to create a new shop
        $shop = Shop::create($shopData);

        return $shop;
    }

    public function getShopDetails($shopId)
    {        // Logic to retrieve details of a specific shop
        $shop = Shop::find($shopId);

        return $shop;
    }

    public function updateShop($shopId, $shopData)
    {        // Logic to update details of a specific shop
        $shop = Shop::find($shopId);
        $shop->update($shopData);

        return $shop;
    }

    public function deleteShop($shopId)
    {        // Logic to delete a specific shop
        $shop = Shop::find($shopId);
        $shop->delete();

        return $shop;
    }
}
