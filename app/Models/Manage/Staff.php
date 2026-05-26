<?php

namespace App\Models\Manage;

use App\Models\LearningCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'learning_center_id',
        'name',
        'phone_number',
        'email',
        'title',
        'specialty',
        'role',
        'status',
    ];

    public function learningCenter(): BelongsTo
    {
        return $this->belongsTo(LearningCenter::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'staff_id');
    }

    /**
     * O'qituvchining guruhlari orqali unga tegishli o'quvchilarni olish
     */
    public function students()
    {
        // Guruhlar orqali ko'pga-ko'p munosabatdagi o'quvchilarni ulash
        return $this->hasManyThrough(
            Student::class,
            Group::class,
            'staff_id', // Group jadvalidagi tashqi kalit
            'id',        // Student jadvalidagi asosiy kalit (student_group orqali bog'lanish uchun pastki mantiq kerak)
            'id',        // Staff jadvalidagi asosiy kalit
            'id'         // Bu oddiy hasManyThrough mantiqi, ko'pga-ko'p orqali o'tishda baribir custom query yoki controller yechimi afzal
        );
    }
}