<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OwnerReservationController;
use Illuminate\Support\Facades\Route;

// トップページ
Route::get('/', function () {
    return redirect()->route('shops.index');
});

// 店舗一覧・詳細（ログイン不要）
Route::resource('shops', ShopController::class)
    ->only(['index', 'show']);

// 認証済みルート
Route::middleware(['auth', 'verified'])->group(function () {

    // 店舗管理（オーナーのみ）
    Route::middleware('owner')->group(function () {
        Route::resource('shops', ShopController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy']);

        // オーナーの予約管理
        Route::get('owner/reservations', [OwnerReservationController::class, 'index'])
            ->name('owner.reservations.index');
        Route::get('owner/reservations/{reservation}', [OwnerReservationController::class, 'show'])
            ->name('owner.reservations.show');
    });

    // 予約管理（一般ユーザーのみ）
    Route::resource('reservations', ReservationController::class);
});
require __DIR__.'/auth.php';
