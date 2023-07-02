<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->comment('The key for the setting, naming convention should be using dot notation. E.g. area.system.setting');
            $table->text('value')->comment('The value of the setting, always stored as a string in the DB.');
            $table->string('type')->default('text')->comment('The type of data the setting holds. Will be used as a hint for processing the return type or front end form.');
            $table->boolean('visible')->default(true)->comment('Indicates if the setting should be visible on the front end.');
            $table->timestamps();

            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
