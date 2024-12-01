<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EducationInfoComponent extends Component
{
    public function __construct(
        public string|null $education = null,
        public string|null $nameSchool = null,
        public string|null $qualification = null,
        public string|null $graduateYear = null,
        public string|null $gpa = null
    ) {}

    public function render(): View
    {
        return view('components.student.education-info-component');
    }
}
