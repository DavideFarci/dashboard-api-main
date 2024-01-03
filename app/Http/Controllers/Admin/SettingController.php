<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{


   


  
    public function allupdate(Request $request)
    {
        $settings = Setting::all();
        //dd($settings[1]);


        $data = $request->all();

      
        if(isset($data['status1'])){
            $settings[0]->status    = true;
        }else{
            $settings[0]->status    = false;
        }
        $settings[0]->update();

        if(isset($data['status2'])){
            $settings[1]->status    = true;
        }else{
            $settings[1]->status    = false;
        }
        $settings[1]->update();
        if(isset($data['status3'])){
            $settings[2]->status    = true;
        }else{
            $settings[2]->status    = false;
        }
        $settings[2]->from      = $data['from'];
        $settings[2]->to        = $data['to'];
        $settings[2]->update();

        //$settings[2]->status    = $data['status3'];
       // $settings->update();



        // ridirezionare su una rotta di tipo get
        return to_route('admin.dashboard');
    }

}
