<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ["email" => "admin@gmail.com"],
            ["name" => "Admin",
            "role" => "Admin", 
            "password" =>Hash::make("123456")]
        );
    }
}
