<?php

namespace App\Utils;

use Carbon\Carbon;

class NumberGenerator
{
    /**
     * Generate an LPO number in the format LPO-SH-YYMMDD-XX.
     *
     * @param int $number
     * @return string
     */
    public static function generateLpoNumber(int $number, string $shop_code): string
    {
        $date = Carbon::now()->format('ymd');
        $paddedNumber = str_pad($number, 2, '0', STR_PAD_LEFT);

        return "LPO-{$shop_code}-{$date}-{$paddedNumber}";
    }

    /**
     * Generate a delivery note number in the format DN-SH-YYMMDD-XX.
     *
     * @param int $number
     * @param string $shop_code
     * @return string
     */
    public static function generateDeliveryNoteNumber(int $number, string $shop_code): string
    {
        $date = Carbon::now()->format('ymd');
        $paddedNumber = str_pad($number, 2, '0', STR_PAD_LEFT);

        return "DN-{$shop_code}-{$date}-{$paddedNumber}";
    }

    /**
     * Generate a three-character shop code from a shop name.
     *
     * @param string $shopName
     * @return string
     */
    public static function generateShopCode(string $shopName): string
    {
        $code = strtoupper(substr($shopName, 0, 3));

        return str_pad($code, 3, 'X', STR_PAD_RIGHT);
    }
}
