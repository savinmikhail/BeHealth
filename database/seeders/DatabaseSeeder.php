<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::create([
             'name' => 'Aldar',
             'email' => 'aldar@mail.com',
             'gender' => 'male',
             'age' => 18,
             'height' => 183,
             'avatar' => 'avatar',
             'notifications_enabled' => 1,
         ]);

        \App\Models\Unit::create([
            'name' => 'pill',
            'code' => 'Таблетка',
        ]);

        \App\Models\Kit::create([
            'user_id' => 1,
            'unit_id' => 1,
            'name' => 'Xanax',
            'amount' => 18,
        ]);

    }

}
