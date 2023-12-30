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
        Schema::create('game_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->restrictOnDelete();
            $table->boolean('is_publisher')->default(false);
            $table->boolean('is_developer')->default(false);
            $table->boolean('is_supporting')->default(false);
            $table->boolean('is_porting')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_companies');
    }
};
