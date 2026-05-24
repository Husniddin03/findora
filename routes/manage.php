<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\LidController;
use App\Http\Controllers\Manage\TeacherController;
use App\Http\Controllers\Manage\GroupController;
use App\Http\Controllers\Manage\CourseController;
use App\Http\Controllers\Manage\ScheduleController;
use App\Http\Controllers\Manage\AttendanceController;
use App\Http\Controllers\Manage\FinanceController;
use App\Http\Controllers\Manage\StaffController;
use App\Http\Controllers\Manage\NotificationController;
use App\Http\Controllers\Manage\SettingController;

Route::get('manage/{center}', [DashboardController::class, 'index'])->name('manage');

Route::get('finances/{center}', [FinanceController::class, 'index'])->name('finances');

Route::get('lids/{center}', [LidController::class, 'index'])->name('lids');

Route::get('teachers/{center}', [TeacherController::class, 'index'])->name('teachers');

Route::get('groups/{center:slug}', [GroupController::class, 'index'])->name('groups');
Route::post('groups/{center:slug}/store', [GroupController::class, 'store'])->name('groups.store');
Route::put('groups/{center:slug}/{group}/update', [GroupController::class, 'update'])->name('groups.update');
Route::delete('groups/{center:slug}/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

Route::get('courses/{center}', [CourseController::class, 'index'])->name('courses');
Route::post('courses/{center}/store', [CourseController::class, 'store'])->name('courses.store');
Route::put('courses/{center}/{course}/update', [CourseController::class, 'update'])->name('courses.update');

Route::get('schedules/{center}', [ScheduleController::class, 'index'])->name('schedules');

Route::get('attendances/{center}', [AttendanceController::class, 'index'])->name('attendances');

Route::get('staff/{center}', [StaffController::class, 'index'])->name('staff');

Route::get('notifications/{center}', [NotificationController::class, 'index'])->name('notifications');

Route::get('settings/{center}', [SettingController::class, 'index'])->name('settings');