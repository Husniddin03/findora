<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Manage\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(LearningCenter $center)
    {
        $rooms = $center->rooms()->withCount('schedules')->get();
        return view('manage.rooms.index', compact('center', 'rooms'));
    }

    public function store(Request $request, LearningCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $center->rooms()->create($validated);

        return redirect()->back()->with('success', 'Xona muvaffaqiyatli qo\'shildi.');
    }

    public function update(Request $request, LearningCenter $center, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $room->update($validated);

        return redirect()->back()->with('success', 'Xona ma\'lumotlari yangilandi.');
    }

    public function destroy(LearningCenter $center, Room $room)
    {
        if ($room->schedules()->exists()) {
            return redirect()->back()->with('error', 'Ushbu xonaga darslar biriktirilgan, o\'chirish imkonsiz.');
        }

        $room->delete();
        return redirect()->back()->with('success', 'Xona muvaffaqiyatli o\'chirildi.');
    }
}