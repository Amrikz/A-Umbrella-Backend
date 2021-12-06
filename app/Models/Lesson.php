<?php

namespace App\Models;

use App\Models\Homeworks\Homework;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    protected $fillable = [
        'name',
        'zoom_link',
    ];

    public function homework()
    {
        return $this->hasMany(Homework::class, 'lesson_id', 'id');
    }

    public function relevant_homework()
    {
        return $this->hasMany(Homework::class, 'lesson_id', 'id')
            ->whereDate('end_date', '>=', now()->toDateString());
    }
}
