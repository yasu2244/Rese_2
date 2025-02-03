<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreShopRequest;
use App\Http\Requests\Owner\UpdateShopRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 店舗作成フォーム表示
    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();
        return view('owner.shop-create', compact('areas', 'genres'));
    }

    // 店舗情報保存処理
    public function store(StoreShopRequest $request)
    {
        $imagePath = $request->file('image')->store('shops', 'public');

        Shop::create([
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'image_url' => $imagePath,
            'owner_id' => auth()->id(),
            'qr_code' => Str::uuid(), 
        ]);

        return redirect()->route('owner.dashboard')->with('success', '店舗が作成されました。');
    }

    // 担当店舗一覧ページ
    public function index()
    {
        $shops = Shop::where('owner_id', auth()->id())->get();

        return view('owner.shops-list', compact('shops'));
    }

    // 店舗更新フォーム表示
    public function edit($id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', auth()->id())->firstOrFail();
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner.shop-update', compact('shop', 'areas', 'genres'));
    }

    // 店舗情報更新処理
    public function update(UpdateShopRequest $request, $id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', auth()->id())->firstOrFail();

        try {
            $validatedData = $request->validated(); // バリデーションの実行
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('バリデーションエラー', [
                'errors' => $e->errors(),
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 更新処理
        $data = $request->only(['name', 'description', 'area_id', 'genre_id']);
        if ($request->hasFile('image')) {
            if ($shop->image_url) {
                \Storage::disk('public')->delete($shop->image_url);
            }
            $data['image_url'] = $request->file('image')->store('shops', 'public');
        }
        $shop->update($data);

        return redirect()->route('owner.dashboard')->with('success', '店舗情報が更新されました。');
    }

}
