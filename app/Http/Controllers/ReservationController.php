<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //reservationsから特定のデータがないのでReservation::class
        $this->authorize('viewAny', Reservation::class);
        //認証されたユーザーの予約情報とその中の店舗を最新順に10件ずつ表示
        $reservations = auth()->user()
            ->reservations()
            ->with('shop')
            ->latest()
            ->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Reservation::class);
        $shop = request('shop_id') ? Shop::findOrFail(request('shop_id')) : null;
        $shops = Shop::all();
        return view('reservations.create', compact('shops', 'shop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        auth()->user()->reservations()->create($request->validated());
        return redirect()->route('reservations.index')
            ->with('success', '予約を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $reservation->update($request->validated());
        return redirect()->route('reservations.index')
            ->with('success', '予約を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', '予約をキャンセルしました');
    }
}
