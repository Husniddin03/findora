<?php

namespace App\View\Components\Manage\Schedule;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Create extends Component
{
    public $center;
    public $groups;
    public $rooms;
    
    public function __construct($center, $groups, $rooms)
    {
        $this->center = $center;
        $this->groups = $groups;
        $this->rooms = $rooms;
    }

    public function render(): View|Closure|string
    {
        return view('components.manage.schedule.create');
    }
}
