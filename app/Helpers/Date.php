<?php

namespace App\Helpers;

class Date
{
    public static function convertFromADToBE($year): string
    {
        return $year + 543;
    }

    public static function convertFromBEToAD($year): string
    {
        return $year - 543;
    }
}
