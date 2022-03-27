<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
     public function Restaurantimage()
    {
    	return $this->hasOne(Restaurantimage::class);
    }
}
