<?php

namespace App\View\Components\Manage\Courses;

use App\Models\LearningCenter;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public LearningCenter $center;

    public function __construct(LearningCenter $center)
    {
        $this->center = $center;
    }

    public function render(): View|Closure|string
    {
        return view('components.manage.courses.edit');
    }
}
