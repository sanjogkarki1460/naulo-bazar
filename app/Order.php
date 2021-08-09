<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //protected $fillable= ['user_id','date','code','shipping_address','payment_type','grand_total','coupon_discount'];
    protected $guarded=[];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function refund_requests()
    {
        return $this->hasMany(RefundRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickup_point()
    {
        return $this->belongsTo(PickupPoint::class);
    }
}
