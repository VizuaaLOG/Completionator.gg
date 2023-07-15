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
        Schema::table('platforms', function(Blueprint $table) {
            $table->date('purchase_date')->after('description')->nullable();
            $table->date('release_date')->after('purchase_date')->nullable();
            $table->string('manufacturer')->after('purchase_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platforms', function(Blueprint $table) {
            $table->dropColumn('purchase_date');
            $table->dropColumn('release_date');
            $table->dropColumn('manufacturer');
        });
    }
};
