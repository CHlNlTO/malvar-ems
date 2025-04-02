<?php

// database/seeders/EnvironmentalClearanceSeeder.php

namespace Database\Seeders;

use App\Models\EnvironmentalClearance;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EnvironmentalClearanceSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();
        $statuses = ['approved', 'pending', 'rejected'];
        $remarks = [
            'approved' => [
                'Compliant with all environmental regulations.',
                'Approved after inspection of waste management facilities.',
                'Environmental impact assessment passed successfully.',
                'Waste disposal methods meet municipal standards.',
                'All required documentation has been verified and approved.'
            ],
            'pending' => [
                'Awaiting on-site inspection.',
                'Additional documentation requested from company.',
                'Under review by environmental committee.',
                'Pending waste management plan approval.',
                'Awaiting results of water quality assessment.'
            ],
            'rejected' => [
                'Failed to meet minimum waste disposal requirements.',
                'Environmental impact assessment revealed significant concerns.',
                'Incomplete documentation provided.',
                'Non-compliance with hazardous waste handling protocols.',
                'Water discharge testing showed unacceptable pollution levels.'
            ]
        ];

        // Create historical clearance requests (3-6 months ago)
        foreach ($companies as $company) {
            // Create 2-4 historical clearances per company
            $numHistorical = rand(2, 4);

            for ($i = 0; $i < $numHistorical; $i++) {
                $daysAgo = rand(90, 180); // 3-6 months ago
                $status = $statuses[array_rand($statuses)];
                $remarksList = $remarks[$status];

                EnvironmentalClearance::create([
                    'company_id' => $company->company_id,
                    'submission_date' => Carbon::now()->subDays($daysAgo)->format('Y-m-d'),
                    'status' => $status,
                    'remarks' => $remarksList[array_rand($remarksList)],
                    'created_at' => Carbon::now()->subDays($daysAgo),
                    'updated_at' => Carbon::now()->subDays($daysAgo - rand(5, 15)), // Decision made 5-15 days later
                ]);
            }
        }

        // Create current clearance requests (last 90 days)
        foreach ($companies as $company) {
            // Create 1-3 recent clearances per company
            $numRecent = rand(1, 3);

            for ($i = 0; $i < $numRecent; $i++) {
                $daysAgo = rand(0, 90); // 0-90 days ago

                // Recent clearances more likely to be pending
                $statusProbability = rand(1, 10);
                if ($statusProbability <= 6) {
                    $status = 'pending';
                } elseif ($statusProbability <= 9) {
                    $status = 'approved';
                } else {
                    $status = 'rejected';
                }

                $remarksList = $remarks[$status];

                EnvironmentalClearance::create([
                    'company_id' => $company->company_id,
                    'submission_date' => Carbon::now()->subDays($daysAgo)->format('Y-m-d'),
                    'status' => $status,
                    'remarks' => $status == 'pending' ? null : $remarksList[array_rand($remarksList)],
                    'created_at' => Carbon::now()->subDays($daysAgo),
                    'updated_at' => $status == 'pending'
                        ? Carbon::now()->subDays($daysAgo)
                        : Carbon::now()->subDays(rand(0, $daysAgo)),
                ]);
            }
        }
    }
}
