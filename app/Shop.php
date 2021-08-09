<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
  protected $appends=['shop_logo'];
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getShopLogoAttribute(){
     if($this->logo != null){
       return asset($this->logo);
     }else{
       return asset('/image/logo.png');
     }
  }
}
