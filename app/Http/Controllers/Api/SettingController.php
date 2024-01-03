<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::all();

        return response()->json([
            'success' => true,
            'results' => $settings,
        ]);
    }
}
