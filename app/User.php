<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  /**
   * Create a many to many relationship with Shop
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function shops(){
      return $this->belongsToMany(Shop::class)->withPivot('like')->withTimestamps();
    }
}
