<?php

namespace App\View\Components\Manage\Group;

use Closure;
use App\Models\LearningCenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public LearningCenter $center;
    public function __construct(LearningCenter $center)
    {
        $this->center = $center;
    }

    public function render(): View|Closure|string
    {
        return view('components.manage.group.show');
    }
}
