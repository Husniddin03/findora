<?php

namespace App\View\Components\Manage\Group;

use Closure;
use App\Models\LearningCenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public LearningCenter $center;
    public $courses;
    public $teachers;
    public function __construct($courses, LearningCenter $center, $teachers)
    {
        $this->center = $center;
        $this->courses = $courses;
        $this->teachers = $teachers;
    }   

    public function render(): View|Closure|string
    {
        return view('components.manage.group.edit');
    }
}
