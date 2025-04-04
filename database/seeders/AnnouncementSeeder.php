<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Waste Collection Schedule Update',
                'description' => 'Due to the upcoming holiday, there will be changes to the regular waste collection schedule. Please check the updated schedule for your barangay.',
                'url' => null,
                'file' => null,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(25),
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Environmental Clearance Deadline',
                'description' => 'All businesses operating within Malvar are reminded that the deadline for environmental clearance renewal is approaching. Please submit your requirements before the end of the month.',
                'url' => null,
                'file' => null,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(20),
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Clean and Green Campaign',
                'description' => 'Join us in our municipality-wide Clean and Green Campaign. Together, we can make Malvar a cleaner and more sustainable place to live.',
                'url' => null,
                'file' => null,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(2),
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Waste Segregation Guidelines',
                'description' => 'New waste segregation guidelines have been implemented. Please properly segregate your waste into biodegradable, non-biodegradable, and hazardous materials.',
                'url' => null,
                'file' => null,
                'start_date' => Carbon::now()->subDays(15),
                'end_date' => Carbon::now()->addDays(45),
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
