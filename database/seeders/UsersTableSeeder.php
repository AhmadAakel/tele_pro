<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            
            'firstname' => "ahmad",
            'lastname' => "akel",
            'email' => "ahmad.akel@gmail.com",
            'phone' => "0992673673",
            'verification_code' =>'111111',
            'password' => Hash::make('12345678'),
            'is_verified' => true,
            'is_admin' => true,
            'email_verified_at' => now(),
            'telegram_channel_url' => 'no channel',
            'updated_at' => now(),
            'created_at' => now()
        ]);
    }
}
