<?php

namespace App\Http\Requests\Manage\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Huquqlar nazorati (middleware orqali qilingani ma'qul)
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required', 
                'string', 
                'max:255',
                // Faqat shu o'quv markazi ichida kurs nomi unikal bo'lishi kerak
                Rule::unique('courses')->where(function ($query) {
                    return $query->where('learning_center_id', $this->route('center')->id);
                })
            ],
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1|max:24',
            'lessons_per_week' => 'required|integer|min:1|max:7',
            'lesson_duration_minutes' => 'required|integer|min:30|max:300',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Kurs nomini kiritish shart.',
            'title.unique' => 'Ushbu o\'quv markazida bunday nomli kurs allaqachon mavjud.',
            'price.required' => 'Kurs narxini kiritish shart.',
            'price.numeric' => 'Narx faqat raqamlardan iborat bo\'lishi kerak.',
        ];
    }
}
