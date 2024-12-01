<?php

namespace App\Helpers;

class Date
{
    public static function getCurrentYear(): string
    {
        return date('Y');
    }

    public static function getCurrentDateTH(): string
    {
        return date('d-m-') . ((int) date('Y') + 543);
    }

    public static function convertFromADToBE($year): string|null
    {
        if ($year != null) {
            $year = $year + 543;
        }

        return $year;
    }

    public static function convertFromBEToAD($year): string|null
    {
        if ($year != null) {
            $year = $year - 543;
        }

        return $year;
    }

    public static function convertToBirthDate($date): string|null
    {
        if ($date == null) return $date;

        $date = new \DateTime($date);
        $day = $date->format('d');
        $month = [
            '01' => 'มกราคม',
            '02' => 'กุมภาพันธ์',
            '03' => 'มีนาคม',
            '04' => 'เมษายน',
            '05' => 'พฤษภาคม',
            '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม',
            '08' => 'สิงหาคม',
            '09' => 'กันยายน',
            '10' => 'ตุลาคม',
            '11' => 'พฤศจิกายน',
            '12' => 'ธันวาคม'
        ][$date->format('m')];
        $year = (int) $date->format('Y') + 543;

        return "$day $month $year";
    }
}
