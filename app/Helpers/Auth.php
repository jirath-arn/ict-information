<?php

namespace App\Helpers;

use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Scholarship;
use App\Enums\Income;
use App\Enums\Life;
use App\Enums\Transfer;

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

        if ($role == Role::STUDENT)        $role = 'นักศึกษา';
        elseif ($role == Role::TEACHER)    $role = 'อาจารย์';
        else                               $role = 'ผู้ดูแลระบบ';

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

        if ($prefix == Prefix::MR)         $prefix = 'นาย';
        elseif ($prefix == Prefix::MISS)   $prefix = 'นางสาว';
        else                               $prefix = 'นาง';

        return "$prefix $first_name $last_name";
    }

    public static function getFullNameWithPrefixEN(): string
    {
        $prefix = auth()->user()->prefix->value;
        $first_name = auth()->user()->first_name_en;
        $last_name = auth()->user()->last_name_en;

        if ($prefix == Prefix::MR)         $prefix = 'Mr.';
        elseif ($prefix == Prefix::MISS)   $prefix = 'Miss';
        else                               $prefix = 'Mrs.';

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

    public static function formatPrefix($prefix): string|null
    {
        if ($prefix == Prefix::MR)          $prefix = 'Mr.';
        elseif ($prefix == Prefix::MISS)    $prefix = 'Miss';
        elseif ($prefix == Prefix::MRS)     $prefix = 'Mrs.';
        else                                $prefix = null;
        return $prefix;
    }

    public static function convertPrefixFromENToTH($prefix): string|null
    {
        if ($prefix == Prefix::MR)          $prefix = 'นาย';
        elseif ($prefix == Prefix::MISS)    $prefix = 'นางสาว';
        elseif ($prefix == Prefix::MRS)     $prefix = 'นาง';
        else                                $prefix = null;
        return $prefix;
    }

    public static function convertEducationFromENToTH($education): string|null
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
            default:
                $education = null;
        }
        return $education;
    }

    public static function convertScholarshipFromENToTH($scholarship): string|null
    {
        if ($scholarship == Scholarship::YES)       $scholarship = 'ได้รับทุน';
        elseif ($scholarship == Scholarship::NO)    $scholarship = 'ไม่ได้รับทุน';
        else                                        $scholarship = null;
        return $scholarship;
    }

    public static function convertTransferFromENToTH($transfer): string|null
    {
        if ($transfer == Transfer::NORMAL)          $transfer = 'ปกติ';
        elseif ($transfer == Transfer::TRANSFER)    $transfer = 'เทียบโอน';
        else                                        $transfer = null;
        return $transfer;
    }

    public static function convertReligionFromENToTH($religion): string|null
    {
        switch ($religion) {
            case "BUDDHISM":
                $religion = 'พุทธ';
                break;
            case "CHRISTIANITY":
                $religion = 'คริสต์';
                break;
            case "ISLAM":
                $religion = 'อิสลาม';
                break;
            case "HINDUISM":
                $religion = 'ฮินดู';
                break;
            case "JUDAISM":
                $religion = 'ยิว';
                break;
            case "SIKHISM":
                $religion = 'ซิกข์';
                break;
            default:
                $religion = null;
        }
        return $religion;
    }

    public static function convertIncomeFromENToTH($income): string|null
    {
        if ($income == Income::HIGH)        $income = 'มากกว่า 300,000 บาทต่อปี';
        elseif ($income == Income::MEDIUM)  $income = '150,000 - 300,000 บาทต่อปี';
        elseif ($income == Income::LOW)     $income = 'น้อยกว่า 150,000 บาทต่อปี';
        else                                $income = null;
        return $income;
    }

    public static function convertLifeFromENToTH($life): string|null
    {
        if ($life == Life::YES)     $life = 'มีชีวิตอยู่';
        elseif ($life == Life::NO)  $life = 'เสียชีวิต';
        else                        $life = null;
        return $life;
    }

    public static function convertPrefixFromTHToEN($prefix): string|null
    {
        if ($prefix == 'นาย')           $prefix = Prefix::MR;
        elseif ($prefix == 'นางสาว')    $prefix = Prefix::MISS;
        elseif ($prefix == 'นาง')       $prefix = Prefix::MRS;
        else                            $prefix = null;
        return $prefix;
    }

    public static function convertTransferFromTHToEN($transfer): string|null
    {
        if ($transfer == 'เทียบโอน') $transfer = Transfer::TRANSFER;
        elseif ($transfer == 'ปกติ') $transfer = Transfer::NORMAL;
        else                        $transfer = null;
        return $transfer;
    }
}
