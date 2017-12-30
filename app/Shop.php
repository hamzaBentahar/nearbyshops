<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $fillable = ['picture', 'name', 'email', 'city', 'latitude', 'longitude'];

    public function users(){
      return $this->belongsToMany(User::class)->withPivot('like')->withTimestamps();
    }

    public function getList(){
      return DB::table('shops')
        ->get();
    }
}
