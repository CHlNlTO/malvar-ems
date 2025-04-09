<?php

// database/seeders/BarangaySeeder.php

namespace Database\Seeders;

use App\Models\Barangay;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = [
            ['name' => 'Bagong Pook', 'population' => 5200, 'area' => 3.5],
            ['name' => 'Bilucao', 'population' => 4300, 'area' => 2.8],
            ['name' => 'Bulihan', 'population' => 6100, 'area' => 4.2],
            ['name' => 'Luta Norte', 'population' => 3800, 'area' => 2.5],
            ['name' => 'Luta Sur', 'population' => 4100, 'area' => 2.7],
            ['name' => 'Poblacion', 'population' => 8200, 'area' => 5.1],
            ['name' => 'San Andres', 'population' => 5600, 'area' => 3.9],
            ['name' => 'San Fernando', 'population' => 6200, 'area' => 4.3],
            ['name' => 'San Gregorio', 'population' => 5400, 'area' => 3.7],
            ['name' => 'San Isidro', 'population' => 4900, 'area' => 3.2],
            ['name' => 'San Juan', 'population' => 5300, 'area' => 3.6],
            ['name' => 'San Pedro I', 'population' => 4700, 'area' => 3.0],
            ['name' => 'San Pedro II', 'population' => 5100, 'area' => 3.4],
            ['name' => 'San Pioquinto', 'population' => 4500, 'area' => 2.9],
            ['name' => 'Santiago', 'population' => 5800, 'area' => 4.0],
        ];

        foreach ($barangays as $barangay) {
            Barangay::create($barangay);
        }
    }
}
