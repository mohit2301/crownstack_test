<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
protected $guarded =[];

public function items () {
    return $this->hasMany('App\CartItem', 'Cart_id');
}
}
