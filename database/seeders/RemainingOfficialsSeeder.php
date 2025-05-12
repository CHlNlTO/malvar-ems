<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\Barangay;
use Illuminate\Database\Seeder;

class RemainingOfficialsSeeder extends Seeder
{
    public function run(): void
    {
        $barangays = Barangay::all()->keyBy('name');

        // Barangay Bulihan
        $this->seedBarangayOfficials('Bulihan', $barangays, [
            ['name' => 'Elpidio Lintan Tosino', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Amelita Lat Linatoc', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Isagani Del Mundo Lat', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Nelson Manalo Lat', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Pedrito Lat Tosino', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Hermogenes Marquese De Leon', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Roberto Lintan Olan', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Emer Rivera Linga', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Antonio Jr. Lat Tan', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Margarito Linga Hernandez', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Bulihan', $barangays, [
            ['name' => 'Ren Bryann Custodio Lat', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Jerome Angelo Recio', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Mark Louie Recio Galola', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Charlene May Datuin Lat', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Jerald Umali Tumagan', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Kc May Valenzuela Linatoc', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Christine Recio Carandang', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'John Kenneth Laylay Lat', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Joh Carl Quidol Abia', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Mary Ellein Garcia Recio', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay Luta Norte
        $this->seedBarangayOfficials('Luta Norte', $barangays, [
            ['name' => 'Henry Liat Olan', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Carmelo Lat Vergara', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Apollo Liat Reyes', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Ludy Mindoro Dimaano', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Sabino Manalo Olan', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Joselito Sumadsad Dimaano', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Cesar Olquin Redondo', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Teodorico Dimaano Sumadsad', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Armando Lat Malabanan', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Wilfredo Dolendo Montecer', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Luta Norte', $barangays, [
            ['name' => 'Nathanael Ines Malabanan', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Althea Ordonio Lat', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Christian Chides Casanova Flotado', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Maria Christelle Sumadsad Lat', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'David Niel San Juan Amata', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Russel Olan Layag', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Sherwin Manalo Reyes', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Jimuel Bico Olan', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Princess Joy M. Olan', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Janjazel M. Redondo', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay Luta Sur
        $this->seedBarangayOfficials('Luta Sur', $barangays, [
            ['name' => 'Nomerito Dela Cruz Marasigan', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Jonil Vanguardia Ada', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Wilfredo Reyes Arcillas', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Rodillo Bernardo Reyes', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Brigido Manalo Vanguardia', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Jaime Abu Garcia', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Wilfredo Abu Garcia', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Randolf Dimaunahan Olan', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Chester Allan Reyes Laloma', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Mary Elaine Vanguardia Briones', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Luta Sur', $barangays, [
            ['name' => 'Philip Andrew Abu Paz', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Harry Kalaw Tamayo', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Gen Mherjoy Kalaw Garcia', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Abel Ghian Alamanza Peñaflor', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Jhon Russel Garcia Aquino', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Mark Jeffrey Reyes Abad', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Fernelyn Lota Araño', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Nathaniel Olave Vanguardia', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Angel A. Evangelista', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'John Ronnel M. Mendoza', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay Poblacion
        $this->seedBarangayOfficials('Poblacion', $barangays, [
            ['name' => 'Simeon B. Magpantay', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Nathaniel M. Israel', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Jimmy Felix E. Lintan', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Valentino L. Cabello', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Eldrin L. Mangubat', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Caridad S. Lat', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Ruby Laydia Miraflor', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Lorna P. Umali', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Edgardo L. Terrenal Jr.', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Glenn DG. Dimaano', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Poblacion', $barangays, [
            ['name' => 'Rafael Miguel R. Custodio', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Camell R. Latayan', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Samantha H. Cayabyab', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Emerson U. Motol', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Arnel I. Dela Peña Jr.', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Crisser Anzell B. Lat', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Kirsten Gyle R. Olan', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Ana Mae F. Faderanga', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Xhiño Jeriele V. Katigbak', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Rosette Ann T. Delantar', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Andres
        $this->seedBarangayOfficials('San Andres', $barangays, [
            ['name' => 'Leo Valencia Morcilla', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Henry De Sagun Valencia', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Bryan Rivera Llanes', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Hannibal Olan Tagle', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Jocelyn Morcilla Oamil', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Coraazon Olan Llanes', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Ronello Fideli Espiritu', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Raquel Valencia De Villa', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Reymond Delos Santos Velasco', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Cesar Tiquio Llanes', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Andres', $barangays, [
            ['name' => 'Christian Nolan Latay Gonzales', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Wendell Apuntar Dimaano', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Joseph Arroyo Bernardos', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Jan Ervin Moico Dimaano', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Justine Mae Bondaug Morcilla', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Al Judel Dimaano Magabo', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Jasmin Joseph Tiquio', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Jan Robert Mendoza Millave', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Hannah Joyce B. Llanes', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Elaiza Mhay A. Llanes', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Fernando
        $this->seedBarangayOfficials('San Fernando', $barangays, [
            ['name' => 'Erwin Lantin Labandelo', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Agusto Aguilera Libario', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Melvin Calma Capanas', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Ginalyn Silva Mendoza', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Allan Reyes Villanueva', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Joel Reyes Alagar', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Ruben Laydia Endaya', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Michael Dan Aguilera Manalo', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Gina Santillan Lazaro', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Elvira Reyes Ilagan', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Fernando', $barangays, [
            ['name' => 'Nick Lauren Dipasupil Manalo', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Alaisa Silva Mendoza', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Kate Aubrey Cabinian Briones', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Alecia Ann Manalo Talatala', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Dexter Aguilera Portugal', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Aerol Aldrich Gutierrez Villanueva', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Ivan Lester Cabuyao Coro', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'John Gibson Tolentino Manalo', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Christian V. Pascua', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Ma. Bernadtte Saagunda', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Isidro
        $this->seedBarangayOfficials('San Isidro', $barangays, [
            ['name' => 'Lucas B. Magpantay', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Amor R. Pangan', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Randy DM. Jumaquio', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Carlos Miguel A. Mendoza', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Nelson B. Magpantay', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Pablo M. Javeña', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Armando U. De Chavez', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Susan D. Garcia', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Maria Elena L. Marquez', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Sarmiento Marquez', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Isidro', $barangays, [
            ['name' => 'Justine Daniel Ingco Marquez', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Maria Angela Del Mundo Reyes', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Kathleen Sarmiento Duque', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'John Clarence Dela Cruz Canila', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Caila Nicole Recamata Sarmiento', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Ma. Eloisa Briones Dela Cruz', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Christian Ray Sarmiento Marquez', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'John Michael Umali Isaga', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'John Lloyd T. Egbuhay', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Faye T. Del Mundo', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Juan
        $this->seedBarangayOfficials('San Juan', $barangays, [
            ['name' => 'Randy Linatoc Torres', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Rommel Olano Viñas', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'John Mark Linatoc Malabanan', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Joseph Tacla Malabanan', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Melicio Tasico Olano Jr.', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Arnel Linatoc Hernandez', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Elsie Malabanan Maranan', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Jimmy Millave Kalalo', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Jone Ann Inao Linatoc', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Emelita Dela Cruz Hernandez', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Juan', $barangays, [
            ['name' => 'Mark Dave Viñas Olano', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Billy Joel Morcilla Linatoc', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Suzette Lim Kalalo', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Kenneth Paran Olan', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Camille Olano Malabanan', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Carlo Judiana', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Rose Ann Linatoc Aguilar', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Justine Olan Bandojo', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Zaira Mae S. Bendejo', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Charlene M. Tasico', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Pedro I
        $this->seedBarangayOfficials('San Pedro I', $barangays, [
            ['name' => 'Pedrito V. Leviste', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Damian L. Carandang', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Ricky U. Maglinao', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Leviste F. Ligaya', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Elvina M. Latayan', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Alex M. Del Valle', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Amando P. Moncayo', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Mario L. Villegas', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Juan G. Gaspacho', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Evelyn L. Barrameda', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Pedro I', $barangays, [
            ['name' => 'Joyce Ann Carla R. Vargas', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Jastine Mae H. Maglinao', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Vindel O. Imperial', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Dian Wendel L. Delos Reyes', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Erick Lawrence E. Rubio', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Julius L. Abao', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Danreb Mathew I. Olan', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Joshua Louis M. Escape', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'John Michael C. Gaspacho', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Engeline R. Imperial', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Pedro II
        $this->seedBarangayOfficials('San Pedro II', $barangays, [
            ['name' => 'Dennis Morfe Lucillo', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Wilson Laiño Custodio', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Romel Paz Camba', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Helen Bolencis Lucillo', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'John Vergelle Morfe Malayan', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Harold Dalida Metica', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Eleodoro Linga De Lara', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Jose Pasco Campano', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Nenita Lat Savandal', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Nemesia Mendoza Banez', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Pedro II', $barangays, [
            ['name' => 'Kathleen Claire Mata Pitogo', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Micah Jelenah Evangelista Saludo', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Erica Gwyn Egia Rubio', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Jay Marco Lucillo Santos', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Sophia Nicole Hopico Villegas', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Hanna Joy Pacia Pitogo', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Mark Joseph Reyes Morfe', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Mark Stephen Jaurigue Alkonga', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Jed Earl Donn L. Mendoza', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Riza A. Reusora', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay San Pioquinto
        $this->seedBarangayOfficials('San Pioquinto', $barangays, [
            ['name' => 'Vicente Millera Villanueva', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Mylene Villanueva Perez', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Guadalope Saludo Gonzales', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Queencie Malabanan Balita', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Floro Unigo Calosa', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Rodolfo Villareal Castillo', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Demetrio Barrion Bulanhagui', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Aniceto Sumadsad Malabanan', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Cynthia Bisarez Alla', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Rosette Magaling Angeles', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('San Pioquinto', $barangays, [
            ['name' => 'Daniella Mae Vivas Miranda', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Jojo Linatoc Dimaano', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Kimberly Joyce Esnaldo Gonzales', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Janna Magaling Angeles', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'Deizel Magsino Cagampang', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'AL Jerald Dela Torre Castillo', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Stephen Ryan Ilao Malolos', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Danica Sobria Lajara', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Rowell U. Genodipa', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Marlene Joy A. Malabanan', 'position' => 'SK Treasurer', 'order' => 10],
        ]);

        // Barangay Santiago
        $this->seedBarangayOfficials('Santiago', $barangays, [
            ['name' => 'Melchor Abrenica Hernandez', 'position' => 'Punong Barangay', 'order' => 1],
            ['name' => 'Gerald Liwanag Madrid', 'position' => 'Barangay Kagawad', 'order' => 2],
            ['name' => 'Sean Elrey Lantin Mendoza', 'position' => 'Barangay Kagawad', 'order' => 3],
            ['name' => 'Noli Lorzano Laja', 'position' => 'Barangay Kagawad', 'order' => 4],
            ['name' => 'Arman Jay Medina Bautista', 'position' => 'Barangay Kagawad', 'order' => 5],
            ['name' => 'Mario Cuevas Anglo', 'position' => 'Barangay Kagawad', 'order' => 6],
            ['name' => 'Ronnie Lajato De Castro', 'position' => 'Barangay Kagawad', 'order' => 7],
            ['name' => 'Elmer Simbahan Saul', 'position' => 'Barangay Kagawad', 'order' => 8],
            ['name' => 'Zerna Ladia Terrenal', 'position' => 'Barangay Secretary', 'order' => 9],
            ['name' => 'Jesse Linatoc Mendoza', 'position' => 'Barangay Treasurer', 'order' => 10],
        ]);

        $this->seedSKOfficials('Santiago', $barangays, [
            ['name' => 'Dustin Miguel Morfe Lat', 'position' => 'SK Chairperson', 'order' => 1],
            ['name' => 'Kim Almira Albarico Saul', 'position' => 'SK Member', 'order' => 2],
            ['name' => 'Gail Ann Saul Lanti', 'position' => 'SK Member', 'order' => 3],
            ['name' => 'Trishia Cuevas Mendoza', 'position' => 'SK Member', 'order' => 4],
            ['name' => 'John Vincent Saul Caringal', 'position' => 'SK Member', 'order' => 5],
            ['name' => 'Mark John Peralta Bornilla', 'position' => 'SK Member', 'order' => 6],
            ['name' => 'Mark Gregy Embile Llanes', 'position' => 'SK Member', 'order' => 7],
            ['name' => 'Mark Dhanwell Reyes Liwanag', 'position' => 'SK Member', 'order' => 8],
            ['name' => 'Kim Daren D. Gusi', 'position' => 'SK Secretary', 'order' => 9],
            ['name' => 'Mark Joseph K. Lajato', 'position' => 'SK Treasurer', 'order' => 10],
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
}
