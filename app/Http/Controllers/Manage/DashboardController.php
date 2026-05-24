<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class DashboardController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.manage", compact("center"));
    }
}