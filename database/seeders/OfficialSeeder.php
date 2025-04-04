<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\Barangay;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run(): void
    {
        $barangays = Barangay::all()->keyBy('name');

        // Barangay Bagong Pook
        $this->seedBarangayOfficials('Bagong Pook', $barangays, [
            ['name' => 'Lilibeth M. Lat', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Elmer M. Tasico', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Lorenzo L. Dela Peña', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Aguinaldo M. Unico', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Orly A. Aguilera', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Rodel M. Arrieta', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Rebecca A. Garcia', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Ralph Jay R. Tasico', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Jean A. Reano', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Maxima C. Libalib', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Bagong Pook', $barangays, [
            ['name' => 'Eljie Voi L. Castillo', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Kyla Vianca L. Aguelera', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Prencess A. Maghirang', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Rosseler A. Tolentino', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Kristine Mae S. Aguilera', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Ma. Kristel E. Millar', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Mico G. Dela Peña', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Carlos Miguel A. Decoy', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Hannah Maye A. Lat', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Terrence B. Macatangay', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay Bilucao
        $this->seedBarangayOfficials('Bilucao', $barangays, [
            ['name' => 'Wilfredo Lat Mendoza', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Marieta Manguiat Del Mundo', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Judy Sandoval Lintan', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Mylene Villapando Custodio', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Mark Del Mundo Buenaflor', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Raven Boa Villapando', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Christian Saba Torres', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Eleanor Mendoza Aguila', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Luzviminda Cabiscuelas Abac', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Rosalie Dela Cruz Villapando', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Bilucao', $barangays, [
            ['name' => 'Kristian Ralph Torres Lintan', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Jaika Lat Tacneng', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Aldred Dela Rosa Del Mundo', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Jhosua Caringal Del Mundo', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Richmond Del Mundo Morcilla', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Marichella Panes Piosca', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Jovet Pondavilla Del Mundo', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Reylan Kingsly Del Mundo Magadia', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Jhea Cabiscuela Velasco', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Jovelyn Delos Santos Tiborio', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Gregorio
        $this->seedBarangayOfficials('San Gregorio', $barangays, [
            ['name' => 'Virgilio M. Linga', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Niña Fe O. De Villa', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Pygay M. Canicola', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Rodillo O. Aquino', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Clarito O. Villapando', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Lyka D. Onte', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Romel A. Unera', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Mario U. Manalo', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Jolina M. Mea', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Francisco U. Torres', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Gregorio', $barangays, [
            ['name' => 'Emiel M. Macandili', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Elaiza M. Del Mundo', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Jhanna Mae C. Manalo', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Nikko M. Ranara', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Alexander Von M. Ancayan', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Jonathan O. Lucillo', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'John Paul DM. Catli', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Dhaniel Lenard DM. Siman', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Joi Anne P. Magpantay', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Lester Jake U. Tolentino', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Add municipal officials
        $this->seedMunicipalOfficials([
            ['name' => 'Tita P. Malvar', 'position' => 'Municipal Mayor', 'order' => 1],
            ['name' => 'Jose P. Clavio', 'position' => 'Municipal Vice Mayor', 'order' => 2],
            ['name' => 'Josephine L. Mendoza', 'position' => 'Municipal Environmental Officer', 'order' => 3],
            ['name' => 'Fernando B. Gonzales', 'position' => 'Municipal Solid Waste Management Officer', 'order' => 4],
            ['name' => 'Elena D. Reyes', 'position' => 'Municipal Engineer', 'order' => 5],
            ['name' => 'Roberto S. Santos', 'position' => 'Municipal Planning Officer', 'order' => 6],
        ]);
    }

    private function seedBarangayOfficials($barangayName, $barangays, $officials)
    {
        $barangayId = null;

        if (isset($barangays[$barangayName])) {
            $barangayId = $barangays[$barangayName]->barangay_id;
        }

        foreach ($officials as $official) {
            Official::create([
                'name' => $official['name'],
                'position' => $official['position'],
                'category' => 'Barangay Officials',
                'barangay_id' => $barangayId,
                'order' => $official['order'],
            ]);
        }
    }

    private function seedSKOfficials($barangayName, $barangays, $officials)
    {
        $barangayId = null;

        if (isset($barangays[$barangayName])) {
            $barangayId = $barangays[$barangayName]->barangay_id;
        }

        foreach ($officials as $official) {
            Official::create([
                'name' => $official['name'],
                'position' => $official['position'],
                'category' => 'SK Officials',
                'barangay_id' => $barangayId,
                'order' => $official['order'],
            ]);
        }
    }

    private function seedMunicipalOfficials($officials)
    {
        foreach ($officials as $official) {
            Official::create([
                'name' => $official['name'],
                'position' => $official['position'],
                'category' => 'Municipal Officials',
                'barangay_id' => null,
                'order' => $official['order'],
            ]);
        }
    }
}
