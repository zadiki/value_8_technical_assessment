<?php

declare(strict_types=1);

namespace App\Utils;

use Carbon\Carbon;

class NumberGenerator
{
    /**
     * Generate an LPO number in the format LPO-SH-YYMMDD-XX.
     */
    public static function generateLpoNumber(int $number, string $store_code): string
    {
        $date = Carbon::now()->format('ymd');
        $paddedNumber = str_pad($number, 2, '0', STR_PAD_LEFT);

        return "LPO-{$store_code}-{$date}-{$paddedNumber}";
    }

    /**
     * Generate a delivery note number in the format DN-SH-YYMMDD-XX.
     */
    public static function generateDeliveryNoteNumber(int $number, string $store_code): string
    {
        $date = Carbon::now()->format('ymd');
        $paddedNumber = str_pad($number, 2, '0', STR_PAD_LEFT);

        return "DN-{$store_code}-{$date}-{$paddedNumber}";
    }

    /**
     * Generate a three-character store code from a store name.
     */
    public static function generateStoreCode(string $storeName): string
    {
        $code = strtoupper(substr($storeName, 0, 3));

        return str_pad($code, 3, 'X', STR_PAD_RIGHT);
    }
}
