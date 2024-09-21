<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'code';

    public function nationalities(): HasMany
    {
        return $this->hasMany(PersonalInformation::class, 'nationality', 'code');
    }

    public function ethnicities(): HasMany
    {
        return $this->hasMany(PersonalInformation::class, 'ethnicity', 'code');
    }
}
