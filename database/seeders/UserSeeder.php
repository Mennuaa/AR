<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "studio", 
                "email" => "studio@gmail.com",
                "password" => Hash::make("studio"),
                "role_id" => "3",
                "phone" => "0777777",
                "image" => "https://cdn.shopify.com/s/files/1/0745/0975/articles/gigachad_1024x1024.jpg?v=1667928905"
            ],
            [
                "name" => "evrogroup", 
                "email" => "evrogroup@gmail.com",
                "password" => Hash::make("evrogroup"),
                "role_id" => "2",
                "phone" => "099999999",
                "image" => "https://upload.wikimedia.org/wikipedia/ru/thumb/9/94/%D0%93%D0%B8%D0%B3%D0%B0%D1%87%D0%B0%D0%B4.jpg/640px-%D0%93%D0%B8%D0%B3%D0%B0%D1%87%D0%B0%D0%B4.jpg"
            ],
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
