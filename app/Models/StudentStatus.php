<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentInformation;

class StudentStatus extends Model
{
    use HasFactory;

    protected $table = 'student_status';
    protected $primaryKey = 'code';

    public function student_information(): HasMany
    {
        return $this->hasMany(StudentInformation::class, 'student_status_code', 'code');
    }
}
