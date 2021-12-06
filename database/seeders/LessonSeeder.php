<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson = new Lesson();

        $lesson->name = 'Профессиональная цифровая грамотность (ПЦГ)';
        $lesson->replicate()->save();

        $lesson->name = 'Основы научных исследований (ОНИ)';
        $lesson->replicate()->save();

        $lesson->name = 'Современная история Казахстана (СИК)';
        $lesson->replicate()->save();

        $lesson->name = 'Иностранный язык';
        $lesson->replicate()->save();

        $lesson->name = 'Казахский язык';
        $lesson->replicate()->save();

        $lesson->name = 'Математика';
        $lesson->replicate()->save();

        $lesson->name = 'Физика';
        $lesson->replicate()->save();

        $lesson->name = 'Физическая культура';
        $lesson->replicate()->save();
    }
}
