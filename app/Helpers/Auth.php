<?php

namespace App\Helpers;

use App\Enums\Prefix;
use App\Enums\Role;

class Auth
{
    public static function getId(): int
    {
        return auth()->user()->id;
    }

    public static function getRoleEN(): string
    {
        return auth()->user()->role->value;
    }

    public static function getRoleTH(): string
    {
        $role = auth()->user()->role->value;

        if ($role === Role::STUDENT)        $role = 'นักศึกษา';
        elseif ($role === Role::TEACHER)    $role = 'อาจารย์';
        else                                $role = 'ผู้ดูแลระบบ';

        return $role;
    }

    public static function getFullNameTH(): string
    {
        $first_name = auth()->user()->first_name_th;
        $last_name = auth()->user()->last_name_th;

        return "$first_name $last_name";
    }

    public static function getFullNameEN(): string
    {
        $first_name = auth()->user()->first_name_en;
        $last_name = auth()->user()->last_name_en;

        return "$first_name $last_name";
    }

    public static function getFullNameWithPrefixTH(): string
    {
        $prefix = auth()->user()->prefix->value;
        $first_name = auth()->user()->first_name_th;
        $last_name = auth()->user()->last_name_th;

        if ($prefix === Prefix::MR)         $prefix = 'นาย';
        elseif ($prefix === Prefix::MISS)   $prefix = 'นางสาว';
        else                                $prefix = 'นาง';

        return "$prefix $first_name $last_name";
    }

    public static function getFullNameWithPrefixEN(): string
    {
        $prefix = auth()->user()->prefix->value;
        $first_name = auth()->user()->first_name_en;
        $last_name = auth()->user()->last_name_en;

        if ($prefix === Prefix::MR)         $prefix = 'Mr.';
        elseif ($prefix === Prefix::MISS)   $prefix = 'Miss';
        else                                $prefix = 'Mrs.';

        return "$prefix $first_name $last_name";
    }

    public static function getFirstCharacterNameTH(): string
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

    public static function getFirstCharacterNameEN(): string
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

    public static function convertPrefixFromENToTH($prefix): string
    {
        if ($prefix === Prefix::MR)         $prefix = 'นาย';
        elseif ($prefix === Prefix::MISS)   $prefix = 'นางสาว';
        else                                $prefix = 'นาง';
        return $prefix;
    }

    public static function convertEducationFromENToTH($education): string
    {
        switch ($education) {
            case "SECONDARY_3":
                $education = 'มัธยมศึกษาปีที่ 3';
                break;
            case "SECONDARY_6":
                $education = 'มัธยมศึกษาปีที่ 6';
                break;
            case "VOC_CERT":
                $education = 'ปวช.';
                break;
            case "HIGH_VOC_CERT":
                $education = 'ปวส.';
                break;
            case "BACHELORS_DEGREE":
                $education = 'ปริญญาตรี';
                break;
            case "MASTERS_DEGREE":
                $education = 'ปริญญาโท';
                break;
            case "PHD":
                $education = 'ปริญญาเอก';
                break;
        }
        return $education;
    }
}
