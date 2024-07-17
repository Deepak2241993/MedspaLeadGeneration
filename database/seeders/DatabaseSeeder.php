<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Check if the super admin user already exists
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super admin',
            ]
        );

        // Check if the sales user already exists
        $salesUser = User::firstOrCreate(
            ['email' => 'sales@example.com'],
            [
                'name' => 'Sales User',
                'password' => Hash::make('password'),
                'role' => 'sales',
            ]
        );

        // Check if the account user already exists
        $accountUser = User::firstOrCreate(
            ['email' => 'account@example.com'],
            [
                'name' => 'Account User',
                'password' => Hash::make('password'),
                'role' => 'account',
            ]
        );
    }
}
