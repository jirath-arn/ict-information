<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FamilyStatus extends Model
{
    use HasFactory;

    protected $table = 'family_status';
    protected $primaryKey = 'id';

    public function family_information(): HasMany
    {
        return $this->hasMany(FamilyInformation::class, 'family_status_id', 'id');
    }
}
