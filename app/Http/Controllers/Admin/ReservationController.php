<?php

namespace App\Http\Controllers\Admin;

use App\Models\Date;
use App\Models\Order;
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

    public function confirmReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation) {
            $reservation->status = 1;
            $reservation->save();
        }
        return redirect("https://wa.me/" . $reservation->phone . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
    }

    public function rejectReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation) {
            $reservation->status = 2;
            $reservation->save();
        }
        return redirect("https://wa.me/" . $reservation->phone . "?text=E' con profondo rammarico che siamo obbligati ad disdire la vostra prenotazione!");
    }
}
