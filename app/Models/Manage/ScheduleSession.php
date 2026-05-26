<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleSession extends Model
{
    protected $fillable = [
        'learning_center_id', 'schedule_id', 'group_id', 'room_id', 'date', 'start_time', 'end_time'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }
}