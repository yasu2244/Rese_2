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
            'email' => 'admin@example.com',
            'password' => Hash::make('1234admin1'),
            'role_id' => 2, // 'admin' ロールのID
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
