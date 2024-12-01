<?php

namespace App\View\Components\Student;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FamilyInfoComponent extends Component
{
    public function __construct(
        public string|null $familyStatus = null,
        public string|null $fatherFullNameTh = null,
        public string|null $fatherFullNameEn = null,
        public string|null $fatherLife = null,
        public string|null $fatherIncome = null,
        public string|null $fatherCareer = null,
        public string|null $motherFullNameTh = null,
        public string|null $motherFullNameEn = null,
        public string|null $motherLife = null,
        public string|null $motherIncome = null,
        public string|null $motherCareer = null,
        public string|null $relativeFullNameTh = null,
        public string|null $relativeFullNameEn = null,
        public string|null $relationship = null,
        public string|null $relativeLife = null,
        public string|null $relativeAddress = null,
        public string|null $relativeIncome = null,
        public string|null $relativeCareer = null
    ) {}

    public function render(): View
    {
        return view('components.student.family-info-component');
    }
}
