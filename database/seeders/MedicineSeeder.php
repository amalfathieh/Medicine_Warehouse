<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scientific_name = ['Ibuprofen', 'Amoxicillin', 'Azithromycin', 'Oseltamivir', 'Acyclovir', 'Amlodipine', 'Losartan', 'Acetaminophen', 'Fluoxetine'];
        $s=[ "Acetylsalicylic acid", "Paracetamol","Lisinopril", "Prednisone", "Fluconazole",  "Sertraline", "Cetirizine", "Diphenhydramine","Codeine", "Levothyroxine",
         "Atorvastatin", "Metformin","Warfarin", "Ciprofloxacin", "Doxycycline"];
         $c=[
            "Aspirin","Tylenol",  "Zestril", "Deltasone",
            "Diflucan", "Zoloft", "Zyrtec", "Benadryl","Codeine phosphate",
            "Synthroid", "Lipitor", "Glucophage",  "Coumadin", "Cipro", "Vibramycin" ];
         $com=[ "Bayer AG",
            "Johnson ",
            "Pfizer Inc.",
            "GlaxoSmithKline plc.",
            "Pfizer Inc.",
            "Roche Holding AG",
            "AstraZeneca plc.",
            "Merck",
            "Prednisone Intensol"," Rayos", "Sterapred", "Deltasone"," Orasone"," Prednicen-M", "Liquid Pred"];
        $commercial_name = ['Advil', 'Amoxil', 'Zithromax', 'Tamiflu', 'Zovirax', 'Norvasc', 'Cozaar', 'Tylenol', 'Prozac'];
        $catogary_id = [4, 1, 1, 2, 2, 3, 3, 9, 7];
        $company = ['Egyptian Drug Company (EDC)', 'Pfizer', 'Roche', 'GlaxoSmithKline', 'Pfizer', 'Merck', 'Pfizer', 'Egyptian Drug Company (EDC)', 'Eli Lilly'];
        $quantity = [100, 50, 500, 35, 40, 160, 40, 37, 15];
        $date = ['2024-03-01', '2024-01-01', '2023-12-01', '2024-01-01', '2024-04-01', '2024-03-01', '2024-06-05', '2025-11-10', '2024-4-1'];
        $price = [4500, 400, 500, 1300, 5000, 7500, 1500, 20000, 2500];
        $image = ['128695.png', '472916.png', '472947.png', '655968.png', '2968933.png', '1480145.png', '12607795.png', '1312075.png', '12413287.png'];

        for ($i = 0; $i < 9; $i++) {
            Medicine::create([
                'scientific_name' => $scientific_name[$i],
                'commercial_name' => $commercial_name[$i],
                'catogary_id' => $catogary_id[$i],
                'company' => $company[$i],
                'quantity' => $quantity[$i],
                'date' => $date[$i],
                'price' => $price[$i],
                'image' => 'image/' . $image[$i],
            ]);
        }
    }
}
