<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_center_id',
        'name',
        'phone_number',
        'parent_phone_number',
        'birth_date',
        'gender',
        'balance',
        'status',
    ];

    /**
     * O'quvchi qaysi markazga tegishli
     */
    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'student_group')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}