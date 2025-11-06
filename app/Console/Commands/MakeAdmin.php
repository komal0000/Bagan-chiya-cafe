<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an admin user with a new password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Enter admin email');
        $password = $this->ask('Enter new password');

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($password);
            $user->save();
            $this->info('Password updated for existing user.');
        } else {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info('Admin user created.');
        }
    }
}
