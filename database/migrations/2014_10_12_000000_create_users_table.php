<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('userType')->nullable()->comment('Student,Employee,Admin');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();

            //addtional field for Student Registration
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('religion')->nullable();
            $table->string('stu_IdNumber')->nullable();
            $table->date('dob')->nullable();
            $table->string('code')->nullable();
            $table->string('role')->nullable()->comment
            ('admin=head of Software,operator=computer operator,user=employee');
            $table->date('join_date')->nullable();
            $table->integer('designation_id')->nullable();
            $table->double('salary')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=InActive; 1=Active');
            //end for filed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
