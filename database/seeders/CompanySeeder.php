<?php

// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Batangas Manufacturing Co.',
                'industry_type' => 'Manufacturing',
                'contact_person' => 'Juan Dela Cruz',
                'email' => 'info@batangasmanufacturing.com',
                'phone' => '(043) 123-4567',
            ],
            [
                'name' => 'Malvar Food Processing Inc.',
                'industry_type' => 'Food Processing',
                'contact_person' => 'Maria Santos',
                'email' => 'contact@malvarfood.com',
                'phone' => '(043) 234-5678',
            ],
            [
                'name' => 'Green Earth Recycling',
                'industry_type' => 'Recycling',
                'contact_person' => 'Pedro Reyes',
                'email' => 'info@greenearth.com',
                'phone' => '(043) 345-6789',
            ],
            [
                'name' => 'Batangas Technical Industries',
                'industry_type' => 'Industrial',
                'contact_person' => 'Ana Dizon',
                'email' => 'contact@bti.com',
                'phone' => '(043) 456-7890',
            ],
            [
                'name' => 'Malvar Agro Processing',
                'industry_type' => 'Agriculture',
                'contact_person' => 'Ramon Bautista',
                'email' => 'info@malvaragro.com',
                'phone' => '(043) 567-8901',
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
