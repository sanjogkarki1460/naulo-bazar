<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('verification_status')->default(0);
            $table->text('verification_info')->nullable();
            $table->integer('cash_on_delivery_status')->default(0);
            $table->double('admin_to_pay')->default(0.00);
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->integer('bank_routing_no')->nullable();
            $table->integer('bank_payment_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
