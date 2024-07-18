<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check and create Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );
        $superAdmin->assignRole('super-admin');

        // Check and create Sales Team Member
        $salesTeam = User::firstOrCreate(
            ['email' => 'salesteam@example.com'],
            [
                'name' => 'Sales Team Member',
                'password' => bcrypt('password'),
            ]
        );
        $salesTeam->assignRole('sales-team');

        // Check and create Account Team Member
        $accountTeam = User::firstOrCreate(
            ['email' => 'accountteam@example.com'],
            [
                'name' => 'Account Team Member',
                'password' => bcrypt('password'),
            ]
        );
        $accountTeam->assignRole('account-team');
    }
}

