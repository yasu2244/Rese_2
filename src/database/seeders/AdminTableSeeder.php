<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User', // 管理者名
            'email' => 'admin@example.com', // メールアドレス
            'password' => Hash::make('1234admin1'), // パスワード
            'role_id' => 2, // 'admin' ロールのID (役割に応じて調整)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
