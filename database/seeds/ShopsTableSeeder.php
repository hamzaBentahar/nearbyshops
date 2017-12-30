<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $shops = json_decode(\Illuminate\Support\Facades\File::get('database/seeds/shops.json'));
    foreach ($shops as $shop) {
      $shopsObj = new \App\Shop();
      $shopsObj->picture = $shop->picture;
      $shopsObj->name = $shop->name;
      $shopsObj->email = $shop->email;
      $shopsObj->city = $shop->city;
      $shopsObj->longitude = $shop->location->coordinates[0];
      $shopsObj->latitude = $shop->location->coordinates[1];
      $shopsObj->save();
    }
  }
}
