<?php

namespace App\View\Components\Teacher;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeacherUpdateComponent extends Component
{
    public function __construct(
        public \stdClass|null $info = null,
        public array|null $prefix = null
    ) {}

    public function render(): View
    {
        return view('components.teacher.teacher-update-component');
    }
}
