<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ShopUser extends Pivot
{
    protected $table = "shop_user";
    protected $fillable = ['like'];
}
