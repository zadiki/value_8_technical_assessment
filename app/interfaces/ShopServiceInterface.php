<?php

namespace App\Interfaces;

interface ShopServiceInterface
{
    public function createShop($shopData);

    public function getShopDetails($shopId);

    public function updateShop($shopId, $shopData);

    public function deleteShop($shopId);
}
