<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $fillable = [
        'learning_center_id',
        'group_id',
        'room_id',
        'day_type',
        'custom_days',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'custom_days' => 'array',
    ];

    public function sessions(): HasMany
    {
        return $this->hasMany(ScheduleSession::class);
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