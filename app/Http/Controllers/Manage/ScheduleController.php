<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class ScheduleController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.schedules.index", compact('center'));
    }
}