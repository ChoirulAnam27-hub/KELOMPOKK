<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Court;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Court::create([
            'name' => 'Lapangan 1 (Interlock Pro)',
            'floor_type' => 'Interlock',
            'price_per_hour' => 150000,
        ]);

        Court::create([
            'name' => 'Lapangan 2 (Rumput Sintetis)',
            'floor_type' => 'Sintetis',
            'price_per_hour' => 130000,
        ]);
        
        Court::create([
            'name' => 'Lapangan 3 (Vinyl Standar)',
            'floor_type' => 'Vinyl',
            'price_per_hour' => 100000,
        ]);
    }
}
