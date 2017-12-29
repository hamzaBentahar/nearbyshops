<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['picture', 'name', 'email', 'city', 'latitude', 'longitude'];

    public function users(){
      return $this->belongsToMany(User::class)->withPivot('like')->withTimestamps();
    }
}
