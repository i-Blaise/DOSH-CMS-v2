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
        Schema::create('pns_video_section', function (Blueprint $table) {
            $table->id();
            $table->string('video_url');
            $table->string('video_title');
            $table->text('video_subtitle');
            $table->text('video_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pns_video_section');
    }
};
