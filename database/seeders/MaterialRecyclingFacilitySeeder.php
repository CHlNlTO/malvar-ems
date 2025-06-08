<?php

namespace Database\Seeders;

use App\Models\MaterialRecyclingFacility;
use App\Models\Barangay;
use Illuminate\Database\Seeder;

class MaterialRecyclingFacilitySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = Barangay::all();

        $mrfData = [
            [
                'name' => 'Malvar Central MRF',
                'location' => 'Poblacion Central Area',
                'barangay_id' => $barangays->where('name', 'Poblacion')->first()?->barangay_id,
                'capacity' => 5000.00,
                'status' => 'active',
                'description' => 'Main material recycling facility serving the central area of Malvar.',
            ],
            [
                'name' => 'San Fernando MRF',
                'location' => 'San Fernando Barangay Hall Complex',
                'barangay_id' => $barangays->where('name', 'San Fernando')->first()?->barangay_id,
                'capacity' => 3500.00,
                'status' => 'active',
                'description' => 'Regional facility serving San Fernando and nearby barangays.',
            ],
            [
                'name' => 'Bagong Pook Community MRF',
                'location' => 'Bagong Pook Elementary School Compound',
                'barangay_id' => $barangays->where('name', 'Bagong Pook')->first()?->barangay_id,
                'capacity' => 2500.00,
                'status' => 'active',
                'description' => 'Community-based recycling facility for Bagong Pook residents.',
            ],
            [
                'name' => 'Bulihan Processing Center',
                'location' => 'Bulihan Industrial Area',
                'barangay_id' => $barangays->where('name', 'Bulihan')->first()?->barangay_id,
                'capacity' => 4000.00,
                'status' => 'active',
                'description' => 'Industrial-grade MRF handling large volume waste processing.',
            ],
            [
                'name' => 'Santiago Eco-Hub',
                'location' => 'Santiago Green Space',
                'barangay_id' => $barangays->where('name', 'Santiago')->first()?->barangay_id,
                'capacity' => 3000.00,
                'status' => 'maintenance',
                'description' => 'Eco-friendly facility currently under maintenance upgrade.',
            ],
            [
                'name' => 'San Isidro Mini MRF',
                'location' => 'San Isidro Community Center',
                'barangay_id' => $barangays->where('name', 'San Isidro')->first()?->barangay_id,
                'capacity' => 1500.00,
                'status' => 'active',
                'description' => 'Small-scale facility for local waste processing.',
            ],
        ];

        foreach ($mrfData as $mrf) {
            if ($mrf['barangay_id']) { // Only create if barangay exists
                MaterialRecyclingFacility::create($mrf);
            }
        }
    }
}
