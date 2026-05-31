<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Manage\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(LearningCenter $center, Request $request)
    {
        // Aktiv guruhlarni yuklash
        $groups = $center->groups()->where('status', 'active')->get();
        
        // Tanlangan guruh (yoki birinchisi)
        $selectedGroupId = $request->input('group_id', $groups->first()?->id);
        $currentGroup = $selectedGroupId ? $center->groups()->with('students')->find($selectedGroupId) : null;

        // Tanlangan yil va oy (Default: Joriy oy)
        $monthParam = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::parse($monthParam . '-01')->startOfMonth();
        $endDate = Carbon::parse($monthParam . '-01')->endOfMonth();

        // 1. Shu oyda dars bo'lgan yoki bo'lishi kerak bo'lgan kunlar ro'yxatini shakllantirish
        // (Schedules jadvalidan yoki davomat kiritilgan tayyor sanalardan olinadi)
        $lessonDates = [];
        if ($currentGroup) {
            // Guruh uchun dars jadvalidan toq/juft kunlarni hisoblash yoki davomat poydevorini olish
            $existingDates = Attendance::where('group_id', $selectedGroupId)
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->pluck('date')
                ->map(fn($date) => $date->format('Y-m-d'))
                ->toArray();

            // Agar davomat hali olinmagan bo'lsa, joriy oyning bugungacha bo'lgan kunlarini kalendar qilib ko'rsatamiz
            $period = $startDate->daysUntil(Carbon::now()->min($endDate));
            foreach ($period as $date) {
                // Yakshanba kunidan tashqari barcha kunlarni dars kuni sifatida vaqtincha ko'rsatamiz
                if ($date->dayOfWeek !== 0) {
                    $lessonDates[] = $date->format('Y-m-d');
                }
            }
            $lessonDates = array_unique(array_merge($lessonDates, $existingDates));
            sort($lessonDates);
        }

        // 2. Mavjud davomatlar matritsasini yuklash
        $attendances = $currentGroup 
            ? Attendance::where('group_id', $selectedGroupId)
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->get()
                ->groupBy(['student_id', function ($item) {
                    return $item->date->format('Y-m-d');
                }])
            : collect();

        // 3. Statistikalarni hisoblash
        $totalLessonsCount = count($lessonDates);
        $todayStr = Carbon::now()->format('Y-m-d');
        
        $todayAbsentsCount = Attendance::where('group_id', $selectedGroupId)
            ->where('date', $todayStr)
            ->where('status', 'absent')
            ->count();

        $allRecords = Attendance::where('group_id', $selectedGroupId)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();
            
        $presentCount = $allRecords->where('status', 'present')->count();
        $totalRecordsCount = $allRecords->count();
        $averageAttendance = $totalRecordsCount > 0 ? round(($presentCount / $totalRecordsCount) * 100, 1) : 100;

        return view("manage.attendances.index", compact(
            'center', 'groups', 'currentGroup', 'lessonDates', 
            'attendances', 'monthParam', 'averageAttendance', 
            'todayAbsentsCount', 'totalLessonsCount'
        ));
    }

    public function storeOrUpdate(Request $request, LearningCenter $center)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'student_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,excused',
            'notes' => 'nullable|string|max:255',
        ]);

        // Agar ma'lumot bazada bo'lsa yangilaydi, bo'lmasa yangi yaratadi (Upsert)
        Attendance::updateOrCreate(
            [
                'learning_center_id' => $center->id,
                'group_id' => $validated['group_id'],
                'student_id' => $validated['student_id'],
                'date' => $validated['date'],
            ],
            [
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]
        );

        return redirect()->back()->with('success', 'Davomat muvaffaqiyatli qayd etildi.');
    }
}