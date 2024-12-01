<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

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
        return view('components.family-update-component');
    }
}
