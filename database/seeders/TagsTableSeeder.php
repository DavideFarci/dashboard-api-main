<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name' => 'pomodoro',  
                'price' => 100,
            ],

            [
                'name' => 'pesto della casa',  
                'price' => 100,
            ],

            [
                'name' => 'melanzane grigliate',  
                'price' => 100,
            ],

            [
                'name' => 'salsa di peperoncini freschi',  
                'price' => 100,
            ],

            [
                'name' => 'passata di pomodoro cotta con ventricina piccante',  
                'price' => 100,
            ],

            [
                'name' => 'aglio',  
                'price' => 100,
            ],

            [
                'name' => 'basilico',  
                'price' => 100,
            ],

            [
                'name' => 'rucola',  
                'price' => 100,
            ],

            [
                'name' => 'foglie del cappero',  
                'price' => 100,
            ],

            [
                'name' => 'carciofini',  
                'price' => 100,
            ],

            [
                'name' => 'funghi',  
                'price' => 100,
            ],

            [
                'name' => 'olive nere',  
                'price' => 100,
            ],

            [
                'name' => 'patate',  
                'price' => 100,
            ],

            [
                'name' => 'cipolla',  
                'price' => 100,
            ],

            [
                'name' => 'radicchio',  
                'price' => 100,
            ],

            [
                'name' => 'verdure di stagione',  
                'price' => 100,
            ],

            [
                'name' => 'origano',  
                'price' => 100,
            ],

            [
                'name' => 'rosmarino',  
                'price' => 100,
            ],

            [
                'name' => 'salsa tartufata',  
                'price' => 100,
            ],

            [
                'name' => 'pesto di basilico',  
                'price' => 100,
            ],

            [
                'name' => 'pomodorino ciliegino',  
                'price' => 100,
            ],

            [
                'name' => 'pomodorino giallo',  
                'price' => 100,
            ],

            [
                'name' => 'pinoli',  
                'price' => 100,
            ],

            [
                'name' => 'pesto di pistacchi della casa',  
                'price' => 100,
            ],

            [
                'name' => 'granella di pistacchi',  
                'price' => 100,
            ],

            [
                'name' => 'noci',  
                'price' => 100,
            ],

            [
                'name' => 'carne salada trentina',  
                'price' => 100,
            ],

            [
                'name' => 'salsiccia',  
                'price' => 100,
            ],

            [
                'name' => 'salame',  
                'price' => 100,
            ],

            [
                'name' => 'mortadella',  
                'price' => 100,
            ],

            [
                'name' => 'ventricina piccante',  
                'price' => 100,
            ],

            [
                'name' => 'arrosto di tacchino in porchetta marchigiano',  
                'price' => 100,
            ],

            [
                'name' => 'würstel',  
                'price' => 100,
            ],

            [
                'name' => 'pancetta marchigiana',  
                'price' => 100,
            ],

            [
                'name' => 'speck',  
                'price' => 100,
            ],

            [
                'name' => 'parmigiano',  
                'price' => 100,
            ],

            [
                'name' => 'mozzarella fior di latte',  
                'price' => 100,
            ],

            [
                'name' => 'mozzarella di bufala campana',  
                'price' => 100,
            ],

            [
                'name' => 'scaglie di grana',  
                'price' => 100,
            ],

            [
                'name' => 'stracciatella',  
                'price' => 100,
            ],

            [
                'name' => 'stracciatella di burrata',  
                'price' => 100,
            ],

            [
                'name' => 'gorgonzola',  
                'price' => 100,
            ],

            [
                'name' => 'pecorino',  
                'price' => 100,
            ],

            [
                'name' => 'acciughe del mar cantabrico',  
                'price' => 100,
            ],

            [
                'name' => 'cotto',  
                'price' => 100,
            ],

            [
                'name' => 'pancetta',  
                'price' => 100,
            ],


        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}

