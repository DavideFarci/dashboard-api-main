<?php

namespace App\Http\Controllers\Admin;

use App\Models\Date;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{


    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(15);
        $dates = Date::all();
        return view('admin.reservations.index', compact('reservations', 'dates'));
    }


    public function show($id)
    {
        $dates = Date::all();
        $reservation = Reservation::where('id', $id)->firstOrFail();
        return view('admin.reservations.show', compact('reservation', 'dates'));
    }

    public function updatestatus($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation) {
            $reservation->status = !$reservation->status; // Inverte lo stato corrente
            $reservation->save();
        }
        return redirect()->back();
    }
}
