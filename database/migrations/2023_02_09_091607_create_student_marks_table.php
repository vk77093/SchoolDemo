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
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stu_id')->constrained('users');
            $table->string('stu_IdNumber');
            $table->foreignId('year_id')->constrained('years');
            $table->foreignId('class_id')->constrained('class_management');
            $table->foreignId('exam_type_id')->constrained('exam_types');
            $table->foreignId('assign_subject_id')->constrained('assign_subjects');
            $table->double('marks');
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
        Schema::dropIfExists('student_marks');
    }
};
