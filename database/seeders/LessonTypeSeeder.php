<?php

namespace Database\Seeders;

use App\Models\LessonType;
use Illuminate\Database\Seeder;

class LessonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessonType = new LessonType();

        $lessonType->name = 'Практика';
        $lessonType->slug = 'practice';
        $lessonType->replicate()->save();

        $lessonType->name = 'Лекция';
        $lessonType->slug = 'lecture';
        $lessonType->replicate()->save();

        $lessonType->name = 'Онлайн';
        $lessonType->slug = 'online';
        $lessonType->replicate()->save();
    }
}
