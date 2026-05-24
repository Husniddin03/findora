<?php

namespace App\Http\Requests\Manage\Group;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'days_type' => 'required|in:odd,even,custom',
            'start_time' => 'required|string',
            'room' => 'required|string|max:50',
            'max_students' => 'required|integer|min:5|max:50',
            'status' => 'required|in:collecting,active,finished',
        ];
    }
}