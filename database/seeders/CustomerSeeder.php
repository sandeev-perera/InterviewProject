<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                "email" => "sandeev.perera@gmail.com",
                "name" => "Sandeev Perera",
                "role" => "Customer", 
                "password" =>Hash::make("123456")
            ],
            [
                 "email" => "david@gmail.com",
                "name" => "David Silva",
                "role" => "Customer", 
                "password" =>Hash::make("123456"),
            ],
            [
                 "email" => "brian@gmail.com",
                "name" => "Brian Gunasekara",
                "role" => "Customer", 
                "password" =>Hash::make("123456")
            ]
        ];
        DB::table("users")->insert($customers);
    }
}
