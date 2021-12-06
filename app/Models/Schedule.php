<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'time',
        'week_day_id',
        'lesson_id',
        'lesson_type_id',
    ];

    public function week_day()
    {
        return $this->hasOne(WeekDay::class, 'id', 'week_day_id');
    }

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }

    public function lesson_type()
    {
        return $this->hasOne(LessonType::class, 'id', 'lesson_type_id');
    }
}
