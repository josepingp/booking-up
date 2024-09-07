<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Cliente 1',
            'email' => 'cliente1@example.com',
            'credit' => 5,
        ]);

        User::factory()->create([
            'name' => 'Cliente 2',
            'email' => 'cliente2@example.com',
            'credit' => 10,
        ]);

        $business = Business::create([
            'name' => 'Business 1',
            'phone' => '123456789',
            'address' => 'Address 1',
            'image' => fake()->imageUrl('Business 1'),
            'max_future_days' => 7,
            'slot_duration' => 30,
        ]);

        $business->schedules()->createMany([
            [
                'day_of_week' => 1,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 2,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 3,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 4,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 5,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 6,
                'open_time' => '08:00',
                'close_time' => '12:00',
            ],
            [
                'day_of_week' => 7,
                'is_closed' => true,
            ],
        ]);


        $business2 = Business::create([
            'name' => 'Business 2',
            'phone' => '1234567890',
            'address' => 'Address 2',
            'image' => fake()->imageUrl('Business 2'),
            'max_future_days' => 10,
            'slot_duration' => 60,
        ]);

        $business2->schedules()->createMany([
            [
                'day_of_week' => 1,
                'open_time' => '08:00',
                'close_time' => '20:00',
            ],
            [
                'day_of_week' => 2,
                'open_time' => '08:00',
                'close_time' => '18:00',
            ],
            [
                'day_of_week' => 3,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 4,
                'open_time' => '08:00',
                'close_time' => '14:00',
            ],
            [
                'day_of_week' => 5,
                'open_time' => '08:00',
                'close_time' => '17:00',
            ],
            [
                'day_of_week' => 6,
                'is_closed' => true,
            ],
            [
                'day_of_week' => 7,
                'is_closed' => true,
            ],
        ]);

    }
}
