<?php

namespace App\Http\Requests\Manage\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required', 
                'string', 
                'max:255',
                // O'zining nomini saqlab qolishga ruxsat berish, lekin boshqa kurs bilan bir xil bo'lmasligi kerak
                Rule::unique('courses')->where(function ($query) {
                    return $query->where('learning_center_id', $this->route('center')->id);
                })->ignore($this->route('course'))
            ],
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1|max:24',
            'lessons_per_week' => 'required|integer|min:1|max:7',
            'lesson_duration_minutes' => 'required|integer|min:30|max:300',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:10',
        ];
    }
}