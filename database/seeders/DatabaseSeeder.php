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
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
