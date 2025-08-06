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
        Schema::table('aboutus', function (Blueprint $table) {
            $table->string('who_we_are_header')->after('who_we_are_caption')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aboutus', function (Blueprint $table) {
            $table->dropColumn('who_we_are_header');
        });
    }
};
