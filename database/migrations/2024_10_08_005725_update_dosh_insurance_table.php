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
        Schema::table('dosh_insurance', function (Blueprint $table) {
            $table->string('insurance_type')->nullable()->after('insurance_name');
            $table->string('home_caption')->nullable()->change();
            $table->string('home_body')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosh_insurance', function (Blueprint $table) {
            $table->dropColumn('insurance_type');
            $table->string('home_caption')->nullable(false)->change();
            $table->string('home_body')->nullable(false)->change();
        });
    }
};
