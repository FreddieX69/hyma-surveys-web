<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'phone' => '30001212',
            'email_verified_at' => now(),
            'role' => 1,
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
        $this->call([
            PermissionSeeder::class,
            FormSeeder::class
        ]);
        $user->assignRole(1);
    }
}
