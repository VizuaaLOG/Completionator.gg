<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('What is the new user\'s name?');
        $email = $this->ask('What is the new user\'s email?');
        $password = $this->secret('What is the new user\'s password?');

        if(empty($name) || empty($email) || empty($password)) {
            $this->error('Missing information.');
            return;
        }

        User::create([
            'name'         => $name,
            'email'        => $email,
            'password'     => Hash::make($password),
            'user_role_id' => UserRole::ADMIN,
        ]);

        $this->line('New user created. Login using the email address and password given.');
    }
}
