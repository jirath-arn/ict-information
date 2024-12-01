<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PersonalUpdateComponent extends Component
{
    public function __construct(
        public \stdClass|null $info = null,
        public string|null $currentDate = null,
        public array|null $scholarship = null,
        public array|null $bloodType = null,
        public array|null $religion = null,
        public array|null $shirtSize = null,
        public Collection|null $countries = null
    ) {}

    public function render(): View
    {
        return view('components.student.personal-update-component');
    }
}
