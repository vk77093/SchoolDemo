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
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stu_id')->constrained('users')->comment('stud_id=user_id');
            $table->foreignId('class_id')->constrained('class_management');
            $table->foreignId('year_id')->constrained('years');
            $table->foreignId('group_id')->constrained('student_groups');
            $table->foreignId('shift_id')->constrained('shift_management');
            $table->string('roll_number')->nullable();
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
        Schema::dropIfExists('assign_students');
    }
};
