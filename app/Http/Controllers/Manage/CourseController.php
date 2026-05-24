<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Http\Requests\Manage\Course\StoreCourseRequest;
use App\Http\Requests\Manage\Course\UpdateCourseRequest;
use App\Models\Manage\Course;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(LearningCenter $center)
    {
        $courses = $center->courses()->latest()->get();
        return view('manage.courses.index', compact('center', 'courses'));
    }

    /**
     * Yangi kursni saqlash
     */
    public function store(StoreCourseRequest $request, LearningCenter $center)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $center->courses()->create($validated);

        return redirect()
            ->route('manage.courses', $center)
            ->with('success', 'Yangi kurs muvaffaqiyatli qo\'shildi!');
    }

    /**
     * Kurs ma'lumotlarini yangilash
     */
    public function update(UpdateCourseRequest $request, LearningCenter $center, Course $course)
    {
        $validated = $request->validated();

        // Agar kurs nomi o'zgargan bo'lsa, slugni ham yangilaymiz
        if ($course->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        }

        $course->update($validated);

        // TUZATILDI: To'g'ri route nomi yozildi
        return redirect()
            ->route('manage.courses', $center)
            ->with('success', 'Kurs ma\'lumotlari muvaffaqiyatli yangilandi!');
    }
}