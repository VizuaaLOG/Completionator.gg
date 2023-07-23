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
        Schema::create('downloadable_content_publishers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\DownloadableContent::class)->constrained('downloadable_content')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadable_content_publishers');
    }
};
