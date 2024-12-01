<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentInfoComponent extends Component
{
    public function __construct(
        public string|null $studentId = null,
        public string|null $fullNameWithPrefixTh = null,
        public string|null $fullNameWithPrefixEn = null,
        public string|null $rmuttoEmail = null,
        public string|null $studentStatus = null,
        public string|null $level = null,
        public string|null $year = null,
        public string|null $advisorFullNameWithPrefixTh = null,
        public string|null $advisorTel = null,
        public string|null $advisorRmuttoEmail = null
    ) {}

    public function render(): View
    {
        return view('components.student.student-info-component');
    }
}
