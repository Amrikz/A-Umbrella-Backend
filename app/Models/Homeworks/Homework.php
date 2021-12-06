<?php

namespace App\Models\Homeworks;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homeworks';

    protected $fillable = [
        'description',
        'end_date',
        'lesson_id',
    ];

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class, 'homework_id', 'id');
    }
}
