<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = ['Antibiotic', 'Antiviral', 'Antihypertensive', 'Anti-inflammatory', 'Immune stimulant'
            , 'Antifungal', 'Antidepressant', 'Antihistamine', 'Analgesic', 'Dietary supplement'];
        for ($i = 0; $i < 10; $i++) {
            Category::query()->create([
                'category' => $category_names[$i],
            ]);
        }
        }
}
