<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('times_slots') as $objTime) {

            $times_slots = Time::create([
                'time_slot'             => $objTime['time_slot'],
                'visible'               => $objTime['visible'],
            ]);
            
        }
    }
    
}
