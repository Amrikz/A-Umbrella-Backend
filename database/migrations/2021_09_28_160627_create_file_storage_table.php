<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_storage', function (Blueprint $table) {
            $table->id();
            $table->string('name',1024)->nullable();
            $table->string('src', 2048)->unique();
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('users', function (Blueprint $table)
        {
            $table->foreign('avatar_id')->references('id')->on('file_storage')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropForeign('users_avatar_id_foreign');
        });

        Schema::dropIfExists('file_storage');
    }
}
