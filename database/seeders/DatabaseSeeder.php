<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Administrator',
            'address' => 'Malang',
            'phone' => '08512345678',
            'email' => 'admin@gmail.com',
            'role' => "adm",
            'password' => Hash::make('admin1234')
        ]);
    }
}