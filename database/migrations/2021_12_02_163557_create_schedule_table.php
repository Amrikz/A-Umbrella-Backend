<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->unsignedBigInteger('week_day_id');
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->unsignedBigInteger('lesson_type_id');
            $table->timestamps();

            $table->foreign('week_day_id')->references('id')->on('week_days')->cascadeOnDelete();
            $table->foreign('lesson_id')->references('id')->on('lessons')->nullOnDelete();
            $table->foreign('lesson_type_id')->references('id')->on('lesson_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
