<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // Use a unique email address
            'password' => bcrypt('password123'), // Use a secure password
            'is_admin' => true, // Set is_admin to true for admin role
        ]);

        // You can also create regular users if needed
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com', // Use a unique email address
            'password' => bcrypt('password123'), // Use a secure password
            'is_admin' => false, // Set is_admin to false for regular users
        ]);
    }
}
