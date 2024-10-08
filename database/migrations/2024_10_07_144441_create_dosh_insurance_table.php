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
        Schema::create('dosh_insurance', function (Blueprint $table) {
            $table->id();
            $table->string('home_caption');
            $table->text('home_body');
            $table->string('insurance_name');
            $table->string('image');
            $table->text('desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosh_insurance');
    }
};
