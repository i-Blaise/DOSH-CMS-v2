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
        Schema::create('pns_page', function (Blueprint $table) {
            $table->id();
            $table->string('header_image');
            $table->string('header_caption');
            $table->text('header_body')->nullable();
            $table->string('pns-video');
            $table->string('video_caption');
            $table->text('video_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pns_page');
    }
};
