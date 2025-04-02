<?php

// database/seeders/GarbageCollectionScheduleSeeder.php

namespace Database\Seeders;

use App\Models\GarbageCollectionSchedule;
use App\Models\Barangay;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GarbageCollectionScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $barangays = Barangay::all();

        // Create schedules for the past 2 weeks (completed and missed)
        for ($day = 14; $day >= 1; $day--) {
            $date = Carbon::now()->subDays($day);

            foreach ($barangays as $index => $barangay) {
                // Schedule each barangay on different days of the week
                if ($index % 3 == $date->dayOfWeek % 3) {
                    $status = rand(0, 10) > 2 ? 'completed' : 'missed'; // 20% chance of missed collection

                    GarbageCollectionSchedule::create([
                        'barangay_id' => $barangay->barangay_id,
                        'collection_date' => $date->format('Y-m-d'),
                        'collection_time' => sprintf('%02d:00:00', 6 + ($index % 8)), // Between 6 AM and 2 PM
                        'status' => $status,
                    ]);
                }
            }
        }

        // Create pending schedules for the next 2 weeks
        for ($day = 0; $day <= 14; $day++) {
            $date = Carbon::now()->addDays($day);

            foreach ($barangays as $index => $barangay) {
                // Schedule each barangay on different days of the week
                if ($index % 3 == $date->dayOfWeek % 3) {
                    GarbageCollectionSchedule::create([
                        'barangay_id' => $barangay->barangay_id,
                        'collection_date' => $date->format('Y-m-d'),
                        'collection_time' => sprintf('%02d:00:00', 6 + ($index % 8)), // Between 6 AM and 2 PM
                        'status' => 'pending',
                    ]);
                }
            }
        }
    }
}
