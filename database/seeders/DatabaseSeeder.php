<?php

namespace Database\Seeders;

use App\Models\ChannelSetting;
use App\Models\User;
use Database\Seeders\ChannelSetting as SeedersChannelSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([SeedersChannelSetting::class]);
        // $this->call([UsersForChannelSeeder::class]);

}
}