<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = intVal($request->year);
        $month = intVal($request->month);
     
        
        $days = Day::where('m', $month)->where('y', $year)->paginate(100);

        return view('admin.days.index', compact('days'));
    }




    public function show($id)
    {
        $day = day::where('id', $id)->firstOrFail();
        $dates = Date::where('day', $day->day)->where('month', $day->m)->where('year', $day->y)->paginate(100);


        return view('admin.days.show', compact('dates'));
   
    }


}
