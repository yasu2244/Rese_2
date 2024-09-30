<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShopCsvRequest;
use App\Models\Shop;

class ShopController extends Controller
{
    public function store(StoreShopCsvRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', '管理者のみがアクセス可能です。');
        }

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads', 'public'); // storage/app/public/uploads に保存
        }

        Shop::create([
            'name' => $validated['name'],
            'area_id' => $this->getAreaId($validated['area']),
            'genre_id' => $this->getGenreId($validated['genre']),
            'description' => $validated['description'],
            'image_url' => $imagePath ?? null, 
        ]);

        return redirect()->back()->with('message', '店舗情報を登録しました。');
    }

    private function getAreaId($areaName)
    {
        $areas = [
            '東京都' => 1,
            '大阪府' => 2,
            '福岡県' => 3,
        ];
        return $areas[$areaName] ?? null;
    }

    private function getGenreId($genreName)
    {
        $genres = [
            '寿司' => 1,
            '焼肉' => 2,
            'イタリアン' => 3,
            '居酒屋' => 4,
            'ラーメン' => 5,
        ];
        return $genres[$genreName] ?? null;
    }
}

