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
        Schema::create('downloadable_content', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\GameStatus::class)->constrained('game_statuses')->restrictOnDelete();
            $table->foreignIdFor(\App\Models\GamePriority::class)->constrained('game_priorities')->restrictOnDelete();
            $table->date('release_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadable_content');
    }
};
