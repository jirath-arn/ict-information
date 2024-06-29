<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Status;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'username',
        'password',
        'first_name_th',
        'last_name_th',
        'first_name_en',
        'last_name_en',
        'rmutto_email',
        'tel'
    ];
    
    protected $hidden = [
        'password'
    ];
    
    protected function casts(): array
    {
        return [
            'prefix' => Prefix::class,
            'role' => Role::class,
            'status' => Status::class,
            'password' => 'hashed'
        ];
    }
}
