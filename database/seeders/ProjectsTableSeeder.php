<?php

namespace Database\Seeders;
use App\Models\Tag;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
{
    $categories = Category::all();
    $categories->shift();

    $tags = Tag::all()->pluck('id');


    for ($i = 0; $i < 5; $i++) {
        $name = $faker->words(rand(1, 2), true);
        $slug = Str::slug($name);
        $image = 'default.png';
        $project = Project::create([
            'category_id'   => $faker->randomElement($categories)->id,
            'name'     => $name,
            'price'    => rand(700,1100),
            'counter'  => 0,
            'image'    => 'public/uploads/' . $image,
            'slug'     => $slug,
        ]);

        $project->tags()->sync($faker->randomElements($tags, 5));
    }
}
}
