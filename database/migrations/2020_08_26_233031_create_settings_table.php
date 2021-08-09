<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->unsigned();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_title');
            $table->string('site_address');
            $table->string('site_phone')->nullable();
            $table->string('site_mobile')->nullable();
            $table->string('site_email')->nullable();
            $table->text('social_links')->nullable();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->string('currency')->nullable();
            $table->text('about')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
