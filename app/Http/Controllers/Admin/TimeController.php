<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  DA SISTEMARE 
    public function toggleTimeVisibility($time_id)
    {
        $time_slot = Time::find($time_id);
        if ($time_slot) {
            $time_slot->visible = !$time_slot->visible; // Inverte lo stato corrente
            $time_slot->save();
        }
        return redirect()->back();
    }

}
