<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    // 予約一覧：本人のみ
    public function viewAny(User $user): bool
    {
        return $user->role === 'user';
    }

    // 予約詳細：本人のみ
    public function view(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }

    // 予約作成：一般ユーザーのみ
    public function create(User $user): bool
    {
        return $user->role === 'user';
    }

    // 予約編集：本人のみ
    public function update(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }

    // 予約削除：本人のみ
    public function delete(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }
    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reservation $reservation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reservation $reservation): bool
    {
        return false;
    }
}
