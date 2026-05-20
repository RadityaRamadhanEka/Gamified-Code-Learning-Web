<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create ADMIN user
        User::factory()->create([
            'name'     => 'Administrator',
            'email'    => 'admin@ngodingajg.com',
            'is_admin' => true,
            'xp'       => 0,
            'level'    => 1,
        ]);

        // Create test user
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create sample users for leaderboard
        $sampleUsers = [
            ['name' => 'VoidWalker', 'xp' => 18500, 'level' => 38],
            ['name' => 'ByteQueen', 'xp' => 14200, 'level' => 29],
            ['name' => 'NullPointer', 'xp' => 12100, 'level' => 25],
            ['name' => 'SyntaxError', 'xp' => 11850, 'level' => 24],
            ['name' => 'CyberNinja', 'xp' => 10920, 'level' => 22],
            ['name' => 'CodeJunkie', 'xp' => 10500, 'level' => 22],
            ['name' => 'GlitchHunter', 'xp' => 9840, 'level' => 20],
        ];

        foreach ($sampleUsers as $userData) {
            User::factory()->create($userData);
        }

        // Seed courses, modules, lessons, quizzes
        $this->call(CourseSeeder::class);
    }
}
