<?php

use App\Models\GameStatus;
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
        GameStatus::find(GameStatus::PLAYING)->update(['type' => 'info']);
        GameStatus::find(GameStatus::COMPLETED)->update(['type' => 'success']);
        GameStatus::find(GameStatus::WONT_PLAY)->update(['type' => 'secondary']);
        GameStatus::find(GameStatus::RETIRED)->update(['type' => 'secondary']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
