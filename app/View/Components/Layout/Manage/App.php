<?php

namespace App\View\Components\Layout\Manage;

use App\Models\LearningCenter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
class App extends Component
{
    public LearningCenter $center;
    public function __construct(LearningCenter $center)
    {
        $this->center = $center;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.layout.manage.app');
    }
}
