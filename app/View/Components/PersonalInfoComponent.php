<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PersonalInfoComponent extends Component
{
    public function __construct(
        public string|null $birthDate = null,
        public string|null $weight = null,
        public string|null $height = null,
        public string|null $email = null,
        public string|null $tel = null,
        public string|null $scholarship = null,
        public string|null $disability = null,
        public string|null $bloodType = null,
        public string|null $nationality = null,
        public string|null $ethnicity = null,
        public string|null $religion = null,
        public string|null $shirtSize = null,
        public string|null $interest = null,
        public string|null $address = null
    ) {}

    public function render(): View
    {
        return view('components.personal-info-component');
    }
}
