<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class TeacherController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.teachers.index", compact('center'));
    }
}