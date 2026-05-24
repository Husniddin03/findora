<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class StaffController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.staff.index", compact("center"));
    }
}