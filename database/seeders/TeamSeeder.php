<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = Team::query()->count();

        if ($count > 0) {
            return;
        }

        Team::create([
            'name' => 'Main',
        ]);
    }
}
