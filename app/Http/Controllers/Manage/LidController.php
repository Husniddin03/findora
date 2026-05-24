<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class LidController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.lids.index", compact('center'));
    }
}