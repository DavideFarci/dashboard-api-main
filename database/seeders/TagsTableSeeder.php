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
            [ 'name' => 'pomodoro',  ],
            [ 'name' => 'pesto della casa',  ],
            [ 'name' => 'melanzane grigliate',  ],
            [ 'name' => 'salsa di peperoncini freschi',  ],
            [ 'name' => 'passata di pomodoro cotta con ventricina piccante',  ],
            [ 'name' => 'aglio',  ],
            [ 'name' => 'basilico',  ],
            [ 'name' => 'rucola',  ],
            [ 'name' => 'foglie del cappero',  ],
            [ 'name' => 'carciofini',  ],
            [ 'name' => 'funghi',  ],
            [ 'name' => 'olive nere',  ],
            [ 'name' => 'patate',  ],
            [ 'name' => 'cipolla',  ],
            [ 'name' => 'radicchio',  ],
            [ 'name' => 'verdure di stagione',  ],
            [ 'name' => 'origano',  ],
            [ 'name' => 'rosmarino',  ],
            [ 'name' => 'salsa tartufata',  ],
            [ 'name' => 'pesto di basilico',  ],
            [ 'name' => 'pomodorino ciliegino',  ],
            [ 'name' => 'pomodorino giallo',  ],
            [ 'name' => 'pinoli',  ],
            [ 'name' => 'pesto di pistacchi della casa',  ],
            [ 'name' => 'granella di pistacchi',  ],
            [ 'name' => 'noci',  ],
            [ 'name' => 'carne salada trentina',  ],
            [ 'name' => 'salsiccia',  ],
            [ 'name' => 'salame',  ],
            [ 'name' => 'mortadella',  ],
            [ 'name' => 'ventricina piccante',  ],
            [ 'name' => 'arrosto di tacchino in porchetta marchigiano',  ],
            [ 'name' => 'würstel',  ],
            [ 'name' => 'pancetta marchigiana',  ],
            [ 'name' => 'speck',  ],
            [ 'name' => 'parmigiano',  ],
            [ 'name' => 'mozzarella fior di latte',  ],
            [ 'name' => 'mozzarella di bufala campana',  ],
            [ 'name' => 'scaglie di grana',  ],
            [ 'name' => 'stracciatella',  ],
            [ 'name' => 'stracciatella di burrata',  ],
            [ 'name' => 'gorgonzola',  ],
            [ 'name' => 'pecorino',  ],
            [ 'name' => 'acciughe del mar cantabrico',  ],
            [ 'name' => 'cotto',  ],
            [ 'name' => 'pancetta',  ],

        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}

