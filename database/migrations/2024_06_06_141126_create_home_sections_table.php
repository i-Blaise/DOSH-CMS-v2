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
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_image');
            $table->string('insurance_caption');
            $table->string('insurance_body', 1000);
            $table->string('finance_image');
            $table->string('finance_caption');
            $table->string('finance_body', 1000);
            $table->string('ride_image');
            $table->string('ride_caption');
            $table->string('ride_body', 1000);
            $table->string('erp_image');
            $table->string('erp_caption');
            $table->string('erp_body', 1000);
            $table->string('commerce_image');
            $table->string('commerce_caption');
            $table->string('commerce_body', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};
