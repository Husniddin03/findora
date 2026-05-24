<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Http\Requests\Manage\Group\StoreGroupRequest;
use App\Http\Requests\Manage\Group\UpdateGroupRequest;
use App\Models\Manage\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request, LearningCenter $center)
    {
        // Kurslarni filtr select uchun yuklaymiz
        $courses = $center->courses()->get();

        // Guruhlarni filtrlash query ob'ekti
        $query = $center->groups()->with('course')->withCount('students');

        // Status bo'yicha filtr (default: active)
        $currentStatus = $request->get('status', 'active');
        $query->where('status', $currentStatus);

        // Kurs bo'yicha filtr
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->get('course_id'));
        }

        $groups = $query->latest()->get();

        // Har bir statusdagi guruhlar sonini hisoblash (Tablar uchun)
        $counts = [
            'active' => $center->groups()->where('status', 'active')->count(),
            'collecting' => $center->groups()->where('status', 'collecting')->count(),
            'finished' => $center->groups()->where('status', 'finished')->count(),
        ];

        return view("manage.groups.index", compact('center', 'courses', 'groups', 'counts', 'currentStatus'));
    }

    public function store(StoreGroupRequest $request, LearningCenter $center)
    {
        $center->groups()->create($request->validated());

        return redirect()
            ->route('manage.groups', $center->slug)
            ->with('success', 'Yangi o\'quv guruhi muvaffaqiyatli ochildi!');
    }

    public function update(UpdateGroupRequest $request, LearningCenter $center, Group $group)
    {
        $group->update($request->validated());

        return redirect()
            ->route('manage.groups', $center->slug)
            ->with('success', 'Guruh ma\'lumotlari muvaffaqiyatli yangilandi!');
    }

    public function destroy(LearningCenter $center, Group $group)
    {
        $group->delete();

        return redirect()
            ->route('manage.groups', $center->slug)
            ->with('success', 'Guruh muvaffaqiyatli o\'chirib tashlandi!');
    }
}