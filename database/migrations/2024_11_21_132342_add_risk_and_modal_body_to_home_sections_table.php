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
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('risk_image')->after('commerce_body')->nullable();
            $table->text('risk_caption')->after('risk_image')->nullable();
            $table->text('risk_body')->after('risk_caption')->nullable();
            $table->text('risk_modal_body')->after('risk_body')->nullable();
            $table->text('commerce_modal_body')->after('commerce_body')->nullable();
            $table->text('erp_modal_body')->after('erp_body')->nullable();
            $table->text('ride_modal_body')->after('ride_body')->nullable();
            $table->text('finance_modal_body')->after('finance_body')->nullable();
            $table->text('insurance_modal_body')->after('insurance_body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn('risk_image');
            $table->dropColumn('risk_caption');
            $table->dropColumn('risk_body');
            $table->dropColumn('risk_modal_body');
            $table->dropColumn('commerce_modal_body');
            $table->dropColumn('erp_modal_body');
            $table->dropColumn('ride_modal_body');
            $table->dropColumn('finance_modal_body');
            $table->dropColumn('insurance_modal_body');
        });
    }
};
