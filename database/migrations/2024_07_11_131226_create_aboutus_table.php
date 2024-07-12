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
        Schema::create('aboutus', function (Blueprint $table) {
            $table->id();
            $table->string('who_we_are_image');
            $table->string('who_we_are_caption');
            $table->string('who_we_are_body', 1000);
            $table->string('mission_image');
            $table->string('mission_caption');
            $table->string('mission_body', 1000);
            $table->string('values_caption');
            $table->string('values_body', 1000);
            $table->string('expertise_caption');
            $table->string('expertise_body', 1000);
            $table->string('inspiration_caption');
            $table->string('inspiration_body', 1000);
            $table->string('banner_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutus');
    }
};
