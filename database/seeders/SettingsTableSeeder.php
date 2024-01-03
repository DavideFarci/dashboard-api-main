<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'Prenotazione Asporti',  
                'status' => true,  
                'from' => '',  
                'to' => '',  
            ],
            [
                'name' => 'Prenotaione Tavoli',  
                'status' => true,  
                'from' => '',  
                'to' => '',  
            ],
            [
                'name' => 'Periodo di Ferie',  
                'status' => false,  
                'from' => '',  
                'to' => '',  
            ],
               
    
            ];
    
            foreach ($settings as $setting) {
                Setting::create($setting);
    
    }
}
}
