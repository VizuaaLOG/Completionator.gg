<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('roles')
          ->insert([
              'id'     => Role::USER,
              'name'   => 'User',
              'system' => true,
          ])
        ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('roles')
          ->where('id', Role::USER)
          ->delete()
        ;
    }
};
