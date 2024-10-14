<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\Education;

class EducationInformation extends Model
{
    use HasFactory;

    protected $table = 'education_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'education',
        'name_school',
        'qualification',
        'graduate_year',
        'gpa'
    ];

    protected function casts(): array
    {
        return [
            'education' => Education::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
