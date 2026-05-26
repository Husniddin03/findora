<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['learning_center_id', 'name', 'capacity'];

    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}