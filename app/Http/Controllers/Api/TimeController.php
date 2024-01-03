<?php

namespace App\Http\Controllers\Api;

use App\Models\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeController extends Controller
{
    public function index() {
        $times_slots = Time::all();

        return response()->json([
            'success' => true,
            'results' => $times_slots,
        ]);
    }
}
