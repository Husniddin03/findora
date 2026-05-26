<?php

namespace App\View\Components\Manage\Student;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public $center;
    public $groups;

    public function __construct($center, $groups)
    {
        $this->center = $center;
        $this->groups = $groups;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.manage.student.edit');
    }
}
