<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;

class FinanceController extends Controller
{
    public function index(LearningCenter $center)
    {
        return view("manage.finances.index", compact("center"));
    }
}