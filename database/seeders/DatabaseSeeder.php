<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'image' => null,
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => '123123',
            'date_of_birth' => null,
            'mobile_number' => '01400125289',
            'address' => 'Dhanmondi, Dhaka - 1209, Bangladesh',
        ]);
    }
}
