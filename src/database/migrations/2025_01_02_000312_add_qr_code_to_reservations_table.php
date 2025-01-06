<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodeToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('qr_code')->unique()->nullable(); // QRコードトークン
            $table->boolean('is_visited')->default(false);    // 来店確認済みフラグ
            $table->timestamp('visited_at')->nullable();      // 来店確認日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['qr_code', 'is_visited', 'visited_at']);
        });
    }
}

