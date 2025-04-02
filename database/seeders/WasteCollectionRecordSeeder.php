<?php

// database/seeders/WasteCollectionRecordSeeder.php

namespace Database\Seeders;

use App\Models\WasteCollectionRecord;
use App\Models\GarbageCollectionSchedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class WasteCollectionRecordSeeder extends Seeder
{
    public function run(): void
    {
        // Get all completed schedules
        $completedSchedules = GarbageCollectionSchedule::where('status', 'completed')->get();

        // Get all collectors
        $collectors = User::where('role', 'collector')->get();
        $collectorCount = $collectors->count();

        if ($collectorCount === 0) {
            // Safety check: if no collectors, create one
            $collector = User::create([
                'name' => 'Emergency Collector',
                'email' => 'emergency.collector@malvar.gov.ph',
                'password' => bcrypt('password'),
                'role' => 'collector',
            ]);
            $collectors = collect([$collector]);
            $collectorCount = 1;
        }

        foreach ($completedSchedules as $index => $schedule) {
            // Assign a random collector for each schedule
            $collector = $collectors[$index % $collectorCount];

            // Generate random but realistic waste volumes based on population
            $population = $schedule->barangay->population;
            $biodegradableBase = $population * 0.0005; // 0.5 kg per person on average
            $nonBiodegradableBase = $population * 0.0003; // 0.3 kg per person on average
            $hazardousBase = $population * 0.00005; // 0.05 kg per person on average

            // Add some randomness
            $biodegradable = round($biodegradableBase * (0.8 + (mt_rand(0, 40) / 100)), 2); // +/- 20%
            $nonBiodegradable = round($nonBiodegradableBase * (0.8 + (mt_rand(0, 40) / 100)), 2); // +/- 20%
            $hazardous = round($hazardousBase * (0.8 + (mt_rand(0, 40) / 100)), 2); // +/- 20%
            $total = $biodegradable + $nonBiodegradable + $hazardous;

            WasteCollectionRecord::create([
                'schedule_id' => $schedule->schedule_id,
                'biodegradable_volume' => $biodegradable,
                'non_biodegradable_volume' => $nonBiodegradable,
                'hazardous_volume' => $hazardous,
                'total_volume' => $total,
                'collector_id' => $collector->id,
            ]);
        }
    }
}
