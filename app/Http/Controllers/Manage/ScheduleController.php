<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Manage\Schedule;
use App\Models\Manage\ScheduleSession;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(LearningCenter $center, Request $request)
    {
        // Hafta filtri boshqaruvi (Masalan: "2026-W22")
        if ($request->filled('week')) {
            $year = substr($request->week, 0, 4);
            $week = substr($request->week, 6);
            $selectedDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
        } else {
            $selectedDate = Carbon::now()->startOfWeek();
        }

        $startOfWeek = $selectedDate->clone()->startOfWeek();
        $endOfWeek = $selectedDate->clone()->endOfWeek();

        // Faqat tanlangan haftadagi dars seanslarini olamiz
        $query = $center->scheduleSessions()
            ->whereBetween('date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->with(['group.teacher', 'group.course', 'room', 'schedule']);

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        $sessions = $query->orderBy('start_time')->get();
        $rooms = $center->rooms()->get();
        $groups = $center->groups()->where('status', 'active')->with(['teacher', 'course'])->get();

        // Vaqt setkasini unikal shakllantirish
        $timeSlots = $sessions->map(function ($item) {
            return substr($item->start_time, 0, 5) . ' - ' . substr($item->end_time, 0, 5);
        })->unique()->sort()->values()->all();

        if (empty($timeSlots)) {
            $timeSlots = ['09:00 - 10:30', '11:00 - 12:30', '14:00 - 15:30', '16:00 - 17:30', '18:30 - 20:00'];
        }

        return view("manage.schedules.index", compact('center', 'timeSlots', 'sessions', 'groups', 'rooms', 'selectedDate'));
    }

    public function store(Request $request, LearningCenter $center)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'room_id' => 'required|exists:rooms,id',
            'range_type' => 'required|in:single_date,current_week,current_month,custom_months,current_year',
            'single_date' => 'required_if:range_type,single_date|date|nullable',
            'day_type' => 'required_unless:range_type,single_date|in:odd,even,workdays_5,workdays_6,everyday,custom',
            'custom_days' => 'required_if:day_type,custom|array',
            'custom_days.*' => 'integer|between:1,6',
            'custom_months' => 'required_if:range_type,custom_months|array',
            'custom_months.*' => 'integer|between:1,12',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $startTime = $request->start_time;
        $endTime = $request->end_time;

        // 1. Agar faqat ma'lum bir kun uchun bo'lsa
        if ($request->range_type === 'single_date') {
            $date = Carbon::parse($request->single_date);
            
            $center->scheduleSessions()->create([
                'group_id' => $request->group_id,
                'room_id' => $request->room_id,
                'date' => $date->format('Y-m-d'),
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);

            return redirect()->back()->with('success', 'Belgilangan kun uchun dars muvaffaqiyatli qo\'shildi.');
        }

        // 2. Seriyali darslar uchun diapazonlarni belgilaymiz
        $today = Carbon::now();
        $startDate = $today->clone()->startOfDay();
        $endDate = $today->clone()->endOfYear(); // Defolt: Yil oxirigacha

        if ($request->range_type === 'current_week') {
            $startDate = $today->clone()->startOfWeek();
            $endDate = $today->clone()->endOfWeek();
        } elseif ($request->range_type === 'current_month') {
            $startDate = $today->clone()->startOfMonth();
            $endDate = $today->clone()->endOfMonth();
        }

        // Qaysi kunlar ekanligini aniqlaymiz
        $targetDays = $this->resolveDays($request->day_type, $request->input('custom_days', []));

        // Seriya yaratish
        $schedule = $center->schedules()->create([
            'group_id' => $request->group_id,
            'room_id' => $request->room_id,
            'day_type' => $request->day_type,
            'custom_days' => $targetDays,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        // Seanslarni sanama-sana generatsiya qilish
        $current = $startDate->clone();
        while ($current->lte($endDate)) {
            $dayOfWeek = $current->dayOfWeek === 0 ? 7 : $current->dayOfWeek; // Kun tartibi: 1=Dush, ..., 7=Yaksh

            if (in_array($dayOfWeek, $targetDays)) {
                // Maxsus oylar filtri tekshiruvi
                if ($request->range_type === 'custom_months' && !in_array($current->month, $request->custom_months)) {
                    $current->addDay();
                    continue;
                }

                $center->scheduleSessions()->create([
                    'schedule_id' => $schedule->id,
                    'group_id' => $request->group_id,
                    'room_id' => $request->room_id,
                    'date' => $current->format('Y-m-d'),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);
            }
            $current->addDay();
        }

        return redirect()->back()->with('success', 'Seriyali darslar jadvalga muvaffaqiyatli joylashtirildi.');
    }

    public function destroy(Request $request, LearningCenter $center, $id)
    {
        $session = ScheduleSession::findOrFail($id);
        $deleteType = $request->input('delete_type', 'only_session');

        if ($deleteType === 'only_session' || !$session->schedule_id) {
            $session->delete();
            return redirect()->back()->with('success', 'Faqatgina shu kungi dars olib tashlandi.');
        }

        $scheduleId = $session->schedule_id;
        $sessionDate = Carbon::parse($session->date);

        switch ($deleteType) {
            case 'all_series': // Butun boshli quyilgan zanjirni o'chirish
                ScheduleSession::where('schedule_id', $scheduleId)->delete();
                Schedule::destroy($scheduleId);
                break;

            case 'this_month': // Faqat shu oydagi qismini o'chirish
                ScheduleSession::where('schedule_id', $scheduleId)
                    ->whereMonth('date', $sessionDate->month)
                    ->whereYear('date', $sessionDate->year)
                    ->delete();
                break;

            case 'future_sessions': // Shu kundan keyingi barcha darslarni o'chirish
                ScheduleSession::where('schedule_id', $scheduleId)
                    ->where('date', '>=', $sessionDate->format('Y-m-d'))
                    ->delete();
                break;
        }

        return redirect()->back()->with('success', 'Belgilangan darslar zanjiri muvaffaqiyatli tozalandi.');
    }

    private function resolveDays(string $type, array $customDays): array
    {
        return match ($type) {
            'odd'        => [1, 3, 5],
            'even'       => [2, 4, 6],
            'workdays_5' => [1, 2, 3, 4, 5],
            'workdays_6' => [1, 2, 3, 4, 5, 6],
            'everyday'   => [1, 2, 3, 4, 5, 6],
            'custom'     => array_map('intval', $customDays),
            default      => []
        };
    }
}