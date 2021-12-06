<?php

namespace Database\Seeders;

use App\Models\WeekDay;
use Illuminate\Database\Seeder;

class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $day = new WeekDay();

        $day->name      = 'Понедельник';
        $day->number    = 1;
        $day->replicate()->save();

        $day->name      = 'Вторник';
        $day->number    = 2;
        $day->replicate()->save();

        $day->name      = 'Среда';
        $day->number    = 3;
        $day->replicate()->save();

        $day->name      = 'Четверг';
        $day->number    = 4;
        $day->replicate()->save();

        $day->name      = 'Пятница';
        $day->number    = 5;
        $day->replicate()->save();

        $day->name      = 'Суббота';
        $day->number    = 6;
        $day->replicate()->save();
    }
}
