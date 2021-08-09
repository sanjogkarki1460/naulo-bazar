<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    protected $appends=['flash_deal_banner'];
    public function flash_deal_products()
    {
        return $this->hasMany(FlashDealProduct::class);
    }

    public function getFlashDealBannerAttribute(){
        if($this->banner){
            return asset($this->banner);
        }else{
            return asset('image/no-image.png');
        }
    }
}
