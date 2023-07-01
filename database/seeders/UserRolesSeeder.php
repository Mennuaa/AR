<?php

namespace Database\Seeders;

use App\Models\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = [
            [
                "name" => "обычный",
                           ],
            [
                "name" => "еврогрупп",
            ],
            [
                "name" => "студия",
            ],
            [
                "name" => "admin",
            ]
        ];
        foreach($userRoles as $userRole){
            UserRoles::create($userRole);
        }
    }
}
