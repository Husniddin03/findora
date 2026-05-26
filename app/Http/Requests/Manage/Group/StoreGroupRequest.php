<?php
namespace App\Http\Requests\Manage\Group;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'staff_id' => 'required|exists:staff,id', // O'qituvchi ID tekshiruvi
            'name' => 'required|string|max:255',
            'days_type' => 'required|in:odd,even,custom',
            'start_time' => 'required',
            'max_students' => 'required|integer|min:1',
            'status' => 'required|in:collecting,active,finished',
        ];
    }
}