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
        Schema::create('game_storefront', function (Blueprint $table) {
            $table->id();
            $table->foreignidFor(\App\Models\Game::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Storefront::class)->constrained()->restrictOnDelete();
            $table->timestamps();

            $table->index(['game_id', 'storefront_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_storefront');
    }
};
