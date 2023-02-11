<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks_grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade_name')->unique();
            $table->integer('grade_point')->unique();
            $table->integer('start_marks');
            $table->integer('end_marks');
            $table->integer('start_point');
            $table->integer('end_point');
            $table->string('remarks');
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
        Schema::dropIfExists('marks_grades');
    }
};
