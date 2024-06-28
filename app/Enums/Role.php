<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class Role extends Enum
{
    const Student = 'STUDENT';
    const Teacher = 'TEACHER';
    const Admin = 'ADMIN';
}
