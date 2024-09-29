<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Relationship extends Model
{
    use HasFactory;

    protected $table = 'relationships';
    protected $primaryKey = 'id';

    public function family_information(): HasMany
    {
        return $this->hasMany(FamilyInformation::class, 'relationship_id', 'id');
    }
}
