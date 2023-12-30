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
        Schema::create('user_game_storefronts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\UserGame::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Storefront::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(\App\Models\Platform::class)->constrained()->restrictOnDelete();
            $table->dateTime('purchased_at');
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game_storefronts');
    }
};
