<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create the user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@parcelpirate.com',
            'password' => Hash::make('password'), // Replace 'your_secure_password' with a real password
        ]);

        // Assuming you have a role named 'Admin'
        $adminRole = Role::where('name', 'Admin')->first();

        // If you are using a many-to-many relationship for user roles
        $adminUser->roles()->attach($adminRole->id);

        // If you are using a one-to-many relationship (a single role_id column in users table)
        // $adminUser->role_id = $adminRole->id;
        // $adminUser->save();
    }
}
