<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 店舗作成フォーム表示
    public function create()
    {
        return view('owner.shop-create'); // 店舗作成用ビュー
    }

    // 店舗情報保存処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'required|file|image|mimes:jpeg,png|max:2048',
        ]);

        // 画像アップロード処理
        $imagePath = $request->file('image')->store('shops', 'public');

        Shop::create([
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'image_url' => $imagePath, // 保存された画像パス
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('owner.dashboard')->with('success', '店舗が作成されました。');
    }

    // 店舗更新フォーム表示
    public function edit()
    {
        $shops = Shop::where('owner_id', auth()->id())->get(); // ログイン中の店舗代表者が担当する店舗
        return view('owner.shop-update', compact('shops'));
    }

    // 店舗情報更新処理
    public function update(Request $request, $id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', auth()->id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'image_url' => 'required|url',
        ]);

        $shop->update($request->only(['name', 'description', 'area_id', 'genre_id', 'image_url']));

        return redirect()->route('owner.dashboard')->with('success', '店舗情報が更新されました。');
    }
}
