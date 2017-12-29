<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUserTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('shop_user', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('shop_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->boolean('like');
      $table->foreign('shop_id')->references('id')->on('shops');
      $table->foreign('user_id')->references('id')->on('users');
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
    Schema::dropIfExists('shop_users');
  }
}
