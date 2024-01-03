<?php

namespace App\Http\Controllers\Api;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    public function index() {
        $slots = Slot::all();

        return response()->json([
            'success' => true,
            'results' => $slots,
        ]);
    }
}
