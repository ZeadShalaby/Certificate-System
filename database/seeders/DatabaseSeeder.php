<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Groups;
use App\Models\Courses;
use App\Models\Certificate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ? users
        $defUser = User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user',
        ]);


        //? Create 10 Users
        $users = User::factory()
            ->count(9)
            ->create();
        $users->push($defUser);


    }
}
