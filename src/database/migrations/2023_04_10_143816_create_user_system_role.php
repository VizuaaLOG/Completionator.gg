<?php

use App\Models\UserRole;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('user_roles')
          ->insert([
              'id'     => UserRole::USER,
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
        DB::table('user_roles')
          ->where('id', UserRole::USER)
          ->delete()
        ;
    }
};
