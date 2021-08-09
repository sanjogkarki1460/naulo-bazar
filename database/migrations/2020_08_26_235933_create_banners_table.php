<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->unsigned();
            $table->string('image');
            $table->boolean('featured');
            $table->boolean('status');
            $table->string('type');
            $table->string('page')->nullable();
            $table->text('position');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('order_item');
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
        Schema::dropIfExists('banners');
    }
}
