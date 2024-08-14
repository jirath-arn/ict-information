<?php

namespace App\Helpers;

class Auth
{
    public static function getFirstNameTH()
    {
        return auth()->user()->first_name_th;
    }

    public static function getLastNameTH()
    {
        return auth()->user()->last_name_th;
    }

    public static function getRole()
    {
        return auth()->user()->role->value;
    }

    public static function getFirstCharacterNameTH()
    {
        $charList = preg_split('//u', auth()->user()->first_name_th, -1, PREG_SPLIT_NO_EMPTY);
        $char = '';

        foreach ($charList as $c) {
            $char = $c;
            $code = mb_ord($c, 'UTF-8');
            if ($code >= 3585 && $code <= 3630) break;
        }

        return $char;
    }

    public static function getFirstCharacterNameEN()
    {
        $charList = preg_split('//u', strtoupper(auth()->user()->first_name_en), -1, PREG_SPLIT_NO_EMPTY);
        $char = '';

        foreach ($charList as $c) {
            $char = $c;
            $code = mb_ord($c, 'UTF-8');
            if ($code >= 65 && $code <= 90) break;
        }

        return $char;
    }
}
