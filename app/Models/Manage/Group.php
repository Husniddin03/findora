<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_center_id',
        'course_id',
        'staff_id', // teacher_name o'rniga foreign key
        'name',
        'days_type', // Masalan: odd, even, custom
        'start_time',
        'max_students',
        'status',
    ];

    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Guruhga biriktirilgan o'qituvchi (Xodim)
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Guruhning dars jadvali setkasi
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_group')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }
}