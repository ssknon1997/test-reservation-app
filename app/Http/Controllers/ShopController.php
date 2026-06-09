<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::with('user')->latest()->paginate(10);
        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Shop::class);
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        $request->user()->shops()->crate($request->validated());
        return redirect()->route('shops.index')
            ->with('succes', '店舗を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop);
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);
        $shop->update($request->validated());
        return redirect()->route('shop.index')
            ->with('succes', '店舗情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $this->authorize('delete', $shop);
        $shop->delete();
        return redirect()->route('shop.index')
            ->with('succes', '店舗を削除しました');
    }
}
