<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EducationUpdateComponent extends Component
{
    public function __construct(
        public \stdClass|null $info = null,
        public string|null $currentYear = null,
        public array|null $education = null
    ) {}

    public function render(): View
    {
        return view('components.student.education-update-component');
    }
}
