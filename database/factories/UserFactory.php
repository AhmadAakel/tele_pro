<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'verification_code' => Str::random(6),
            'password' => Hash::make('password123'),
            'is_verified' => $this->faker->boolean(70), // 70% chance of being verified
            'email_verified_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
            'telegram_channel_url' => null, // Will be set by seeder
            'is_admin' => false,
        ];
    }

    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified' => true,
                'email_verified_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            ];
        });
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified' => false,
                'email_verified_at' => null,
            ];
        });
    }

    public function withChannel($channelUrl)
    {
        return $this->state(function (array $attributes) use ($channelUrl) {
            return [
                'telegram_channel_url' => $channelUrl,
            ];
        });
    }
}