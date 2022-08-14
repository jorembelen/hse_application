<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Location;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(50)->create();
        Location::factory(5)->create();


        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => 'password',
        ]);
        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@user.com',
            'role' => 'user',
            'password' => 'password',
        ]);
    }
}
