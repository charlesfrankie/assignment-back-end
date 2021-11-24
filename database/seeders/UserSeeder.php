<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'editor',
            'remember_token' => Str::random(10),
        ]);
        User::create(
        [
            'name' => 'David',
            'email' => 'david123@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'editor',
            'remember_token' => Str::random(10),
        ]);
    }
}
