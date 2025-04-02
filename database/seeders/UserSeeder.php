<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barangay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@malvar.gov.ph',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'barangay_id' => null,
        ]);

        // Get all barangays
        $barangays = Barangay::all();

        // Create one barangay official for each barangay
        foreach ($barangays as $barangay) {
            User::create([
                'name' => 'Official ' . $barangay->name,
                'email' => 'official.' . strtolower(str_replace(' ', '', $barangay->name)) . '@malvar.gov.ph',
                'password' => Hash::make('password'),
                'role' => 'official',
                'barangay_id' => $barangay->barangay_id,
            ]);

            // Create 5-10 residents for each barangay
            $residentCount = rand(5, 10);
            for ($i = 1; $i <= $residentCount; $i++) {
                User::create([
                    'name' => 'Resident ' . $i . ' of ' . $barangay->name,
                    'email' => 'resident' . $i . '.' . strtolower(str_replace(' ', '', $barangay->name)) . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'resident',
                    'barangay_id' => $barangay->barangay_id,
                ]);
            }
        }

        // Create waste collectors
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Collector ' . $i,
                'email' => 'collector' . $i . '@malvar.gov.ph',
                'password' => Hash::make('password'),
                'role' => 'collector',
                'barangay_id' => null,
            ]);
        }

        // Create company representatives
        $companies = \App\Models\Company::all();
        foreach ($companies as $index => $company) {
            User::create([
                'name' => 'Representative for ' . $company->name,
                'email' => 'rep.' . strtolower(str_replace([' ', '.'], '', $company->name)) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'barangay_id' => null,
            ]);
        }
    }
}
