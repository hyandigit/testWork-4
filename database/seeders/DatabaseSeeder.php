<?php

namespace Database\Seeders;

use App\Models\Product;
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
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        User::factory()->create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        Product::factory(10)->create();
    }
}
