<?php

namespace App\Helpers;

use App\Enums\Prefix;

class Auth
{
    public static function getUsername()
    {
        return auth()->user()->username;
    }

    public static function getRmuttoEmail()
    {
        return auth()->user()->rmutto_email;
    }

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

    public static function getFullNameTH()
    {
        $prefix = auth()->user()->prefix->value;
        $first_name = auth()->user()->first_name_th;
        $last_name = auth()->user()->last_name_th;

        if ($prefix === Prefix::MR)         $prefix = 'นาย';
        elseif ($prefix === Prefix::MISS)   $prefix = 'นางสาว';
        else                                $prefix = 'นาง';

        return "$prefix $first_name $last_name";
    }

    public static function getFullNameEN()
    {
        $prefix = auth()->user()->prefix->value;
        $first_name = auth()->user()->first_name_en;
        $last_name = auth()->user()->last_name_en;

        if ($prefix === Prefix::MR)         $prefix = 'Mr.';
        elseif ($prefix === Prefix::MISS)   $prefix = 'Miss';
        else                                $prefix = 'Mrs.';

        return "$prefix $first_name $last_name";
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
