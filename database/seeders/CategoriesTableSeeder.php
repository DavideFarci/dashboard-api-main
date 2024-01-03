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

            ],
            [
                'name'          => 'Pizze Speciali',
              
            ],
            [
                'name'          => 'Pizze Rosse',
                
            ],
            [
                'name'          => 'Pizze Bianche',
            ],
            [
                'name'          => 'Dolci',
            ],
            [
                'name'          => 'Bibite',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
