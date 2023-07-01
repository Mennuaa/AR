<?php

namespace Database\Seeders;

use App\Models\StudiosManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studioManager = [
            "manager_id" => '2',
            "studio_id" => '1'
        ];
        StudiosManager::create($studioManager);
    }
}
