<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShopPolicy
{
    /**
     * 店舗一覧：誰でも見れる
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * 店舗詳細：誰でも見られる
     */
    public function view(User $user, Shop $shop): bool
    {
        return true;
    }

    /**
     * 店舗作成：オーナーのみ
     */
    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    /**
     * 店舗編集：自分の店舗のみ
     */
    public function update(User $user, Shop $shop): bool
    {
        return $user->isOwner() && $user->id === $shop->user_id;
    }

    /**
     * 店舗削除：自分の店舗のみ
     */
    public function delete(User $user, Shop $shop): bool
    {
        return $user->isOwner() && $user->id === $shop->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Shop $shop): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Shop $shop): bool
    {
        return false;
    }
}
