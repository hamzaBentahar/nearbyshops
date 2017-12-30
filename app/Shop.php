<?php

namespace App;

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

  public function getList()
  {
    $shops = DB::table('shops')->get();
    $shops = $shops->filter(function ($shop) {
      $like = $this->getLike($shop->id);
      $shop->like = isset($like->like) ? $like->like : null;
      if($shop->like){
        return $like->like != 1;
      }
      return true;
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
}
