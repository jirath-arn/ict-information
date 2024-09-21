<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\Scholarship;
use App\Enums\BloodType;
use App\Enums\Religion;
use App\Enums\ShirtSize;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'personal_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nationality',
        'ethnicity',
        'birth_date',
        'weight',
        'height',
        'email',
        'disability',
        'interest',
        'address'
    ];

    protected function casts(): array
    {
        return [
            'scholarship' => Scholarship::class,
            'blood_type' => BloodType::class,
            'religion' => Religion::class,
            'shirt_size' => ShirtSize::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality', 'code');
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'ethnicity', 'code');
    }
}
