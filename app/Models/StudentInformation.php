<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\Transfer;

class StudentInformation extends Model
{
    use HasFactory;

    protected $table = 'student_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'advisor_id',
        'student_status_code',
        'level',
        'year',
        'transfer'
    ];

    protected function casts(): array
    {
        return [
            'transfer' => Transfer::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advisor_id', 'id');
    }

    public function student_status(): BelongsTo
    {
        return $this->belongsTo(StudentStatus::class, 'student_status_code', 'code');
    }
}
