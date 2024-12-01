<?php

namespace App\Helpers;

class Tel
{
    public static function format($tel): string|null
    {
        if ($tel != null) {
            $tel = str_split($tel);
            array_splice($tel, 6, 0, '-');
            array_splice($tel, 3, 0, '-');
            $tel = implode('', $tel);
        }

        return $tel;
    }
}
