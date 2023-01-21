<?php

namespace Database\Seeders;

use App\Models\User;
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
         User::factory()->create([
             'name' => "Administrator",
             'first_name' => "Admin",
             'last_name' => "My Admin",
             'is_admin' => true,
             'email' => "admin@admin.com",
             'password' => 'admin'
         ]);
    }
}
