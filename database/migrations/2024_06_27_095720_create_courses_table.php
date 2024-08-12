<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('title');
            $table->text('short_des');
            $table->text('description');
            $table->string('learn_day');
            $table->string('age');
            $table->time('time_start');
            $table->time('time_end');
            $table->dateTime('from_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->string('avatar')->nullable();
            $table->string('cover_image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
