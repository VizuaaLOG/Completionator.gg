<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')
          ->insert([
              'key'     => 'system.instance_name',
              'value'   => '',
              'type'    => 'text',
              'visible' => true,
          ])
        ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')
          ->where('key', 'system.instance_name')
          ->delete()
        ;
    }
};
