<?php

namespace Database\Seeders;

use App\Models\ChannelSetting as ModelsChannelSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChannelSetting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsChannelSetting::create([
            
            'telegram_channel_url' => "https://t.me/+W0Z2YYibSNw3Zjc8",
            'is_active' => true,
            'user_count' => 47,
            
        ]);
        
    }
}
