<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
  protected $fillable = ['picture', 'name', 'email', 'city', 'latitude', 'longitude'];

  public function users()
  {
    return $this->belongsToMany(User::class)->withPivot('like')->withTimestamps();
  }

  public function getList($latitude, $longitude, $displayOnlyLikes = false)
  {
    $shops = DB::table('shops')->get();
    $shops = $shops->filter(function ($shop) use ($latitude, $longitude, $displayOnlyLikes) {
      $like = $this->getLike($shop->id);
      $shop->like = isset($like->like) ? $like->like : null;
      // Add the distance between the shop and the user for every shop
      $shop->distance = $this->distance(
        ['lat' => $latitude, 'long' => $longitude],
        ['lat' => $shop->latitude, 'long' => $shop->longitude]
      );
      if ($displayOnlyLikes == true){
        // Display only the liked shops
        if($shop->like){
          return $like->like == 1;
        }
      }else{
        // Display all the shops except the liked ones and the disliked ones for 2 hours
        if(!is_null($shop->like)){
          $diffInHours = Carbon::now()->diffInHours(Carbon::createFromFormat('Y-m-d H:i:s', $like->updated_at));
          return !($like->like == 1 or ($like->like == 0 and $diffInHours < 2));
        }else{
          return true;
        }
      }
    });
    return $shops;
  }

  public function getLike($id)
  {
    return DB::table('shop_user')
      ->where('shop_id', $id)
      ->where('user_id', Auth::id())
      ->first();
  }

  /**
   * Compute the radian
   * @param $x
   * @return float|int
   */
  protected function radian($x)
  {
    return $x * pi() / 180;
  }

  /**
   * Formula to compute the distance between 2 points
   * @param $p1
   * @param $p2
   * @return float|int
   */
  protected function distance($p1, $p2)
  {
    $earthRadius = 6378137;
    $dLat = $this->radian($p2['lat'] - $p1['lat']);
    $dLong = $this->radian($p2['long'] - $p1['long']);
    $dist = sin($dLat / 2) * sin($dLat / 2) + cos($this->radian($p1['lat'])) * cos($this->radian($p2['lat'])) * sin($dLong / 2) * sin($dLong / 2);
    $dist = 2 * atan2(sqrt($dist), sqrt(1 - $dist));
    return $earthRadius * $dist * 0.001;
  }
}
