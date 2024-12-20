<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([ 
            'name' => 'Sample User', 
            'email' => 'user@example.com', 
            'password' => Hash::make('password'), 
            'role' => 'user', 
        ]);
        User::factory()->count(20)->create();
    }
}
