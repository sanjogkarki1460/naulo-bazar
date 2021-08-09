<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
  public function user(){
  	return $this->belongsTo(User::class);
  }

  public function payments(){
  	return $this->hasMany(Payment::class);
  }

//    public function vendor_user(){
//        return $this->belongsTo('App\User','user_id');
//    }
}
