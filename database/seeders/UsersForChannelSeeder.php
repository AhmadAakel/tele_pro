<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersForChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the channel URL
        $channelUrl = 'https://t.me/+W0Z2YYibSNw3Zjc8';
        
        // Create 49 users for the same channel
        User::factory()
            ->count(49)
            ->withChannel($channelUrl)
            ->create()
            ->each(function ($user, $index) {
                // Make some users verified and some unverified for variety
                
                    // Every 3rd user is unverified
                    $user->update([
                        'is_verified' => true,
                        'email_verified_at' => fake()->dateTimeBetween('-index months', 'now'),
                        'verification_code' => str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT)
                    ]);
                
                
            });

        $this->command->info('Created 49 users for the channel: ' . $channelUrl);
        
        // Display statistics
        $totalUsers = User::where('is_admin', false)->count();
        $verifiedUsers = User::where('is_admin', false)->where('is_verified', true)->count();
        $unverifiedUsers = User::where('is_admin', false)->where('is_verified', false)->count();
        
        $this->command->info("Statistics:");
        $this->command->info("- Total Users: {$totalUsers}");
        $this->command->info("- Verified Users: {$verifiedUsers}");
        $this->command->info("- Unverified Users: {$unverifiedUsers}");
    }
}