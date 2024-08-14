<?php

namespace App\Helpers;

class Auth
{
    public static function getRole()
    {
        return auth()->user()->role->value;
    }
}
