<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Manage\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // O'quvchilar ro'yxati va filtrlash
    public function index(LearningCenter $center, Request $request)
    {
        $query = $center->students()->with('groups');

        // Qidiruv mantiqi (Qavs ichiga olinmasa, markaz ID si hisobga olinmay qoladi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }

        // Status bo'yicha filtr
        if ($request->filled('status')) {
            if ($request->status === 'debter') {
                $query->where('balance', '<', 0);
            } else {
                $query->where('status', $request->status);
            }
        }

        // Guruh bo'yicha filtr
        if ($request->filled('group_id')) {
            $query->whereHas('groups', function($q) use ($request) {
                $q->where('groups.id', $request->group_id);
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();
        
        // Modallardagi selectlar uchun guruhlar ro'yxati
        $groups = $center->groups()->where('status', '!=', 'finished')->get();

        return view("manage.students.index", compact('center', 'students', 'groups'));
    }

    // Yangi o'quvchi saqlash
    public function store(Request $request, LearningCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'parent_phone_number' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'balance' => 'nullable|numeric',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:groups,id',
        ]);

        // Studentni yaratish
        $student = $center->students()->create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'parent_phone_number' => $validated['parent_phone_number'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'balance' => $validated['balance'] ?? 0,
            'status' => 'active'
        ]);

        // Agar guruhlar tanlangan bo'lsa, ularni ko'pma-ko'p munosabatga bog'laymiz
        if (!empty($request->group_ids)) {
            $attachData = [];
            foreach ($request->group_ids as $groupId) {
                $attachData[$groupId] = ['joined_at' => now()];
            }
            $student->groups()->attach($attachData);
        }

        return redirect()->back()->with('success', 'Oʻquvchi muvaffaqiyatli qoʻshildi.');
    }

    // O'quvchi ma'lumotlarini tahrirlash
    public function update(Request $request, LearningCenter $center, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'parent_phone_number' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,frozen,left',
            'balance' => 'required|numeric',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:groups,id',
        ]);

        $student->update([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'parent_phone_number' => $validated['parent_phone_number'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'status' => $validated['status'],
            'balance' => $validated['balance'],
        ]);

        // Guruhlarni sinxronizatsiya qilish (eskilarini o'chirib, yangilarini yozadi)
        $syncData = [];
        if (!empty($request->group_ids)) {
            foreach ($request->group_ids as $groupId) {
                // Avval guruhda bor bo'lsa joined_at o'zgarmasligi uchun pivotni saqlab qolamiz
                $existingPivot = $student->groups()->where('group_id', $groupId)->first();
                $syncData[$groupId] = [
                    'joined_at' => $existingPivot ? $existingPivot->pivot->joined_at : now()
                ];
            }
        }
        $student->groups()->sync($syncData);

        return redirect()->back()->with('success', 'Oʻquvchi maʻlumotlari yangilandi.');
    }
}