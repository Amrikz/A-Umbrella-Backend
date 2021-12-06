<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_files', function (Blueprint $table) {
            $table->unsignedBigInteger('solution_id');
            $table->unsignedBigInteger('file_id');

            $table->foreign('solution_id')->references('id')->on('solutions')->cascadeOnDelete();
            $table->foreign('file_id')->references('id')->on('file_storage')->cascadeOnDelete();

            $table->primary(['solution_id', 'file_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solution_files');
    }
}
