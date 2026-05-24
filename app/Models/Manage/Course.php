<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_center_id',
        'title',
        'slug',
        'description',
        'price',
        'duration_months',
        'lessons_per_week',
        'lesson_duration_minutes',
        'icon',
        'is_active',
    ];

    /**
     * Kurs qaysi o'quv markaziga tegishli ekanligini olish
     */
    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}