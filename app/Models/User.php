<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Status;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'first_name_th',
        'last_name_th',
        'prefix',
        'first_name_en',
        'last_name_en',
        'rmutto_email',
        'tel',
        'role',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected function casts(): array
    {
        return [
            'prefix' => Prefix::class,
            'role' => Role::class,
            'status' => Status::class
        ];
    }

    public function student_information(): HasOne
    {
        return $this->hasOne(StudentInformation::class, 'user_id', 'id');
    }

    public function personal_information(): HasOne
    {
        return $this->hasOne(PersonalInformation::class, 'user_id', 'id');
    }

    public function family_information(): HasOne
    {
        return $this->hasOne(FamilyInformation::class, 'user_id', 'id');
    }

    public function education_information(): HasOne
    {
        return $this->hasOne(EducationInformation::class, 'user_id', 'id');
    }

    public function advisors(): HasMany
    {
        return $this->hasMany(StudentInformation::class, 'advisor_id', 'id');
    }
}
