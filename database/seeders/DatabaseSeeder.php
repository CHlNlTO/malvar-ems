<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BarangaySeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
        ]);

        $this->call([
            GarbageCollectionScheduleSeeder::class,
            WasteCollectionRecordSeeder::class,
            EnvironmentalClearanceSeeder::class,
            AnnouncementSeeder::class,
            DocumentSeeder::class,
            OfficialSeeder::class,
            RemainingOfficialsSeeder::class,
        ]);
    }
}
