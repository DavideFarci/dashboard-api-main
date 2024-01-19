<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TagsTableSeeder;
use Database\Seeders\SlotsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ProjectsTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\DatesTableSeeder;


class DatabaseSeeder extends Seeder
{
   
    public function run()
    {
     

        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            TagsTableSeeder::class,
            ProjectsTableSeeder::class,
            SettingsTableSeeder::class,
            TimesTableSeeder::class,
            SlotsTableSeeder::class,
            //DatesTableSeeder::class,
        ]);
    }
}
