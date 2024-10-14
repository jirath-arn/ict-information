<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\Life;
use App\Enums\Income;

class FamilyInformation extends Model
{
    use HasFactory;

    protected $table = 'family_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'family_status_id',
        'father_first_name_th',
        'father_last_name_th',
        'father_first_name_en',
        'father_last_name_en',
        'father_life',
        'father_income',
        'father_career_id',
        'mother_first_name_th',
        'mother_last_name_th',
        'mother_first_name_en',
        'mother_last_name_en',
        'mother_life',
        'mother_income',
        'mother_career_id',
        'relative_first_name_th',
        'relative_last_name_th',
        'relative_first_name_en',
        'relative_last_name_en',
        'relative_life',
        'relative_income',
        'address',
        'relationship_id',
        'relative_career_id'
    ];

    protected function casts(): array
    {
        return [
            'father_life' => Life::class,
            'father_income' => Income::class,
            'mother_life' => Life::class,
            'mother_income' => Income::class,
            'relative_life' => Life::class,
            'relative_income' => Income::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function family_status(): BelongsTo
    {
        return $this->belongsTo(FamilyStatus::class, 'family_status_id', 'id');
    }

    public function father_career(): BelongsTo
    {
        return $this->belongsTo(Career::class, 'father_career_id', 'id');
    }

    public function mother_career(): BelongsTo
    {
        return $this->belongsTo(Career::class, 'mother_career_id', 'id');
    }

    public function relative_career(): BelongsTo
    {
        return $this->belongsTo(Career::class, 'relative_career_id', 'id');
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class, 'relationship_id', 'id');
    }
}
