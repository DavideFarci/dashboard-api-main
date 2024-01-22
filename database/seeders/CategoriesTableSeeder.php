<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'          => 'Tutti',
                'slot'          => 0
            ],
            [
                'name'          => 'Pizze Speciali',
                'slot'          => 1
            ],
            [
                'name'          => 'Pizze Rosse',
                'slot'          => 1     
            ],
            [
                'name'          => 'Pizze Bianche',
                'slot'          => 1
            ],
            [
                'name'          => 'Dolci',
                'slot'          => 0
            ],
            [
                'name'          => 'Bibite',
                'slot'          => 0
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
