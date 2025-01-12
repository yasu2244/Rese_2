<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\StoreShopOwnerRequest;
use App\Http\Requests\UpdateShopOwnerRequest;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    // 管理者ダッシュボード
    public function dashboard()
    {
        return view('admin.admin-dashboard');
    }

    // 店舗代表者一覧
    public function listShopOwners()
    {
        $shopOwners = User::where('role_id', 3)->with('shops')->get(); // 関連する店舗情報をロード
        return view('admin.shop-owners-list', compact('shopOwners'));
    }

    // 店舗代表者作成ページ
    public function createShopOwner()
    {
        return view('admin.shop-owner-create');
    }

    // 店舗代表者を保存
    public function storeShopOwner(StoreShopOwnerRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // 店舗代表者ロール
        ]);

        return redirect()->route('admin.shop_owners.list')->with('success', '店舗代表者を作成しました。');
    }

    /// 店舗代表者編集ページ
    public function editShopOwner($id)
    {
        $shopOwner = User::with('shops')->findOrFail($id); // 店舗代表者とその担当店舗を取得

        // 現在の担当店舗と、担当者がいない店舗を取得
        $shops = Shop::where('owner_id', $shopOwner->id)
            ->orWhereNull('owner_id')
            ->get();

        return view('admin.shop-owner-edit', compact('shopOwner', 'shops'));
    }

    // 店舗代表者を更新
    public function updateShopOwner(UpdateShopOwnerRequest $request, $id)
    {
        $shopOwner = User::findOrFail($id);

        $validatedData = $request->validated();

        // ユーザー情報を更新
        $shopOwner->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // 新しい担当店舗のIDを取得
        $newShopIds = $validatedData['shops'] ?? [];

        // 既存の担当店舗を取得
        $currentShops = Shop::where('owner_id', $shopOwner->id)->pluck('id')->toArray();

        // 割り当て解除する店舗
        $shopsToDetach = array_diff($currentShops, $newShopIds);

        // 新しく割り当てる店舗
        $shopsToAttach = array_diff($newShopIds, $currentShops);

        // 担当解除
        if (!empty($shopsToDetach)) {
            Shop::whereIn('id', $shopsToDetach)->update(['owner_id' => null]);
        }

        // 新しい担当店舗を割り当て
        if (!empty($shopsToAttach)) {
            Shop::whereIn('id', $shopsToAttach)->update(['owner_id' => $shopOwner->id]);
        }

        return redirect()->route('admin.shop_owners.list')->with('success', '店舗代表者を更新しました。');
    }



    // 店舗代表者を削除
    public function destroyShopOwner($id)
    {
        $shopOwner = User::findOrFail($id);

        // 担当店舗の関連付けを解除
        Shop::where('owner_id', $shopOwner->id)->update(['owner_id' => null]);

        // 店舗代表者を削除
        $shopOwner->delete();

        return redirect()->route('admin.shop_owners.list')->with('success', '店舗代表者を削除しました。');
    }

    // 担当店舗を表示
    public function viewStores($id)
    {
        // 店舗代表者をrole_idで判別して取得
        $shopOwner = User::with('shops')->where('role_id', 3)->findOrFail($id);

        // 店舗代表者に紐付く店舗を取得
        $stores = $shopOwner->shops;

        // ビューにデータを渡す
        return view('admin.shop-owner-stores', compact('shopOwner', 'stores'));
    }

    // 店舗詳細情報を表示
    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre')->findOrFail($shop_id);
        $reviews = Review::where('shop_id', $shop_id)->with('user')->get();
        $userReview = null;

        if (auth()->check()) {
            $userReview = Review::where('shop_id', $shop_id)
                                ->where('user_id', auth()->id())
                                ->first();
        }

        $today = Carbon::now()->toDateString();

        // 固定の時間スロットを生成
        $timeSlots = [
            '10:00', '10:30', '11:00', '11:30', '12:00',
            '12:30', '13:00', '13:30', '14:00', '14:30',
            '17:00', '17:30', '18:00', '18:30', '19:00',
            '19:30', '20:00', '20:30', '21:00', '21:30', '22:00',
        ];

        return view('detail', compact('shop', 'reviews', 'userReview', 'today', 'timeSlots'));
    }

     // 店舗を削除
    public function destroyStore($id)
    {
        $store = Shop::findOrFail($id);
    
        $store->delete();

        return redirect()->back()->with('success', '店舗を削除しました。');
    }


    // お知らせメール送信ページ
    public function sendEmailPage()
    {
        return view('admin.send-email');
    }

    // お知らせメール送信処理
    public function sendEmail(SendEmailRequest $request)
    {
        // メール送信処理
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to('recipient_email@example.com') // 受信者のメールアドレスに置き換え
                    ->subject($request->subject);
        });

        return redirect()->route('admin.dashboard')->with('success', 'メールを送信しました！');
    }

}
