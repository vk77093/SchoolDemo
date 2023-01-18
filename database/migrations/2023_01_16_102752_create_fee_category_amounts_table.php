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
        
        Schema::create('fee_category_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_cate_id')->constrained('fee_categories');
            $table->foreignId('class_id')->constrained('class_management');
            $table->double('cate_amount');
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
        Schema::dropIfExists('fee_category_amounts');
    }
};
