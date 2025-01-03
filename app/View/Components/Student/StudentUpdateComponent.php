<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class StudentUpdateComponent extends Component
{
    public function __construct(
        public \stdClass|null $info = null,
        public string|null $currentYear = null,
        public array|null $prefix = null,
        public array|null $transfer = null,
        public Collection|null $studentStatus = null,
        public Collection|null $advisors = null
    ) {}

    public function render(): View
    {
        return view('components.student.student-update-component');
    }
}
