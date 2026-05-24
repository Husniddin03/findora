<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_center_id',
        'course_id',
        'name',
        'teacher_name',
        'days_type',
        'start_time',
        'room',
        'max_students',
        'status',
    ];

    /**
     * Guruh qaysi o'quv markaziga tegishli ekanligi
     */
    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    /**
     * Guruh qaysi kurs (fan) yo'nalishi bo'yicha ochilganligi
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Guruhdagi o'quvchilar ro'yxati (Many-to-Many munosabati uchun)
     * (Eslatma: student_group pivot jadvali borligini nazarda tutadi)
     */
    public function students(): BelongsToMany
    {
        // Agar o'quvchilar modeli nomi 'Student' bo'lsa
        return $this->belongsToMany(Student::class, 'student_group');
    }
}