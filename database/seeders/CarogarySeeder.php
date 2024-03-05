<?php

namespace Database\Seeders;

use App\Models\Catogary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarogarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catogary_names = ['Antibiotic', 'Antiviral', 'Antihypertensive', 'Anti-inflammatory', 'Immune stimulant'
            , 'Antifungal', 'Antidepressant', 'Antihistamine', 'Analgesic', 'Dietary supplement'];
        for ($i = 0; $i < 10; $i++) {
            Catogary::query()->create([
                'catogary' => $catogary_names[$i],
            ]);
        }
        }
}
