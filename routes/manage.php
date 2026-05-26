<?php

use App\Http\Controllers\Manage\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\LidController;
use App\Http\Controllers\Manage\StudentController;
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


Route::get('students/{center:slug}', [StudentController::class, 'index'])->name('students');
Route::post('students/{center:slug}', [StudentController::class, 'store'])->name('students.store');
Route::put('students/{center:slug}/{student}', [StudentController::class, 'update'])->name('students.update');

Route::get('groups/{center:slug}', [GroupController::class, 'index'])->name('groups');
Route::post('groups/{center:slug}/store', [GroupController::class, 'store'])->name('groups.store');
Route::put('groups/{center:slug}/{group}/update', [GroupController::class, 'update'])->name('groups.update');
Route::delete('groups/{center:slug}/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

Route::get('courses/{center}', [CourseController::class, 'index'])->name('courses');
Route::post('courses/{center}/store', [CourseController::class, 'store'])->name('courses.store');
Route::put('courses/{center}/{course}/update', [CourseController::class, 'update'])->name('courses.update');

Route::get('schedules/{center:slug}', [ScheduleController::class, 'index'])->name('schedules');
Route::post('schedules/{center:slug}', [ScheduleController::class, 'store'])->name('schedules.store');
Route::put('schedules/{center:slug}/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
Route::delete('schedules/{center:slug}/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

Route::get('rooms/{center:slug}', [RoomController::class, 'index'])->name('rooms');
Route::post('rooms/{center:slug}', [RoomController::class, 'store'])->name('rooms.store');
Route::put('rooms/{center:slug}/{room}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('rooms/{center:slug}/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

Route::get('attendances/{center}', [AttendanceController::class, 'index'])->name('attendances');

Route::get('staff/{center:slug}', [StaffController::class, 'index'])->name('staff');
Route::post('staff/{center:slug}', [StaffController::class, 'store'])->name('staff.store');
Route::put('staff/{center:slug}/{staff}', [StaffController::class, 'update'])->name('staff.update');

Route::get('notifications/{center}', [NotificationController::class, 'index'])->name('notifications');

Route::get('settings/{center}', [SettingController::class, 'index'])->name('settings');