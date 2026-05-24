<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class AttendanceController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.attendances.index", compact('center'));
    }
}