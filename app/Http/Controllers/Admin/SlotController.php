<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    public function toggleTimeVisibility(Request $request, $slot_id)
    {
        $slot = Slot::find($slot_id);
        if ($slot) {
            $slot->visible = !$slot->visible; 
            $slot->save();
        }
        return redirect()->back();
    }
}
