<?php

namespace Database\Seeders;

use App\Models\StudioUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudiouserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studioUsers = [
            [
                "address" => "Russia",
                "working_time" => "8 hours",
                "studio_name" => "AR Studio",
                "user_id" => "1"
            ]
        ];
        foreach ($studioUsers as $studioUser) {
            StudioUsers::create($studioUser);
        }
    }
}
