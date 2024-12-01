<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FamilyUpdateComponent extends Component
{
    public function __construct(
        public \stdClass|null $info = null,
        public array|null $life = null,
        public array|null $income = null,
        public Collection|null $familyStatus = null,
        public Collection|null $careers = null,
        public Collection|null $relationship = null
    ) {}

    public function render(): View
    {
        return view('components.student.family-update-component');
    }
}
