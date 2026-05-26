<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Manage\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(LearningCenter $center, Request $request)
    {
        // Xodimlarni guruhlar soni va o'quvchilar soni bilan yuklash
        // Eslatma: Staff modelida students() munosabati hasManyThrough orqali Groups'ga bog'langan bo'lishi kerak
        $query = $center->staff()->withCount(['groups', 'students as students_count']);

        // Rol bo'yicha tab-filtr
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $staffMembers = $query->latest()->get();

        // Statistika tablari uchun sonlar (Faqat faol va faol bo'lmagan xodimlarni umumiy sanaymiz)
        $counts = [
            'all' => $center->staff()->count(),
            'teacher' => $center->staff()->where('role', 'teacher')->count(),
            'admin' => $center->staff()->whereIn('role', ['admin', 'reception'])->count(),
        ];

        return view("manage.staff.index", compact('center', 'staffMembers', 'counts'));
    }

    public function store(Request $request, LearningCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'title' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'role' => 'required|in:admin,teacher,reception',
        ]);

        $center->staff()->create($validated);

        return redirect()->back()->with('success', 'Xodim muvaffaqiyatli qoʻshildi.');
    }

    public function update(Request $request, LearningCenter $center, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'title' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'role' => 'required|in:admin,teacher,reception',
            'status' => 'required|in:active,inactive',
        ]);

        $staff->update($validated);

        return redirect()->back()->with('success', 'Xodim maʻlumotlari yangilandi.');
    }
}