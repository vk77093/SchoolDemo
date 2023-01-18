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
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_management');
            $table->foreignId('subject_id')->constrained('subject_types');
            $table->decimal('full_mark');
            $table->decimal('pass_mark');
            $table->decimal('subjective_mark');
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
        Schema::dropIfExists('assign_subjects');
    }
};
