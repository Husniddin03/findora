<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class SettingController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.settings.index", compact('center'));
    }
}