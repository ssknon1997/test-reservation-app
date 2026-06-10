<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class OwnerReservationController extends Controller
{

    public function index()
    {
        $reservations = auth()->user()
            ->shops()
            //1つのModelで複数のリレーションテーブルを取得する場合['', '']で書く
            ->with(['reservations.user', 'reservations.shop'])
            ->get()
            ->pluck('reservations')
            ->flatten()
            ->sortByDesc('reserved_at');

        return view('owner.reservations.index', compact('reservations'));
    }

    public function show(Shop $shop, $reservationId)
    {
        $reservation = $shop->reservations()->findOrFail($reservationId);
        return view('owner.reservations.show', compact('reservation'));
    }
}
