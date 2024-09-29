<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';
    protected $primaryKey = 'id';

    public function father_family_information(): HasMany
    {
        return $this->hasMany(FamilyInformation::class, 'father_career_id', 'id');
    }

    public function mother_family_information(): HasMany
    {
        return $this->hasMany(FamilyInformation::class, 'mother_career_id', 'id');
    }

    public function relative_family_information(): HasMany
    {
        return $this->hasMany(FamilyInformation::class, 'relative_career_id', 'id');
    }
}
