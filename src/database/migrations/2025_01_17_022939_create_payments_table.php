<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');    // 予約との関連
            $table->string('stripe_payment_id')->nullable(); // Stripe支払いID
            $table->integer('amount');
            $table->enum('status', ['pending', 'succeeded', 'failed'])->default('pending'); // 支払いステータス
            $table->enum('method', ['credit_card', 'qr_code'])->default('credit_card');     // 支払い方法
            $table->string('qr_code_url')->nullable();       // 支払い用QRコードURL
            $table->timestamps();
        
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->unique(['reservation_id', 'method']);  // 予約ごとに1つの支払い方法のみ
        });        
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

