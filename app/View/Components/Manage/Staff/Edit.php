<?php

namespace App\View\Components\Manage\Staff;

use Closure;
use App\Models\LearningCenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    public $center;
    
    public function __construct(LearningCenter $center)
    {
        $this->center = $center;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.manage.staff.edit');
    }
}
