<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;
use App\Models\Referal;
use App\Models\Cart;
use Miracuthbert\Royalty\Traits\CollectsPoints;
use Overtrue\LaravelSubscribe\Traits\Subscriber;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;
    use LaratrustUserTrait;
    use HasApiTokens, Notifiable;
    use Subscriber;
    use CollectsPoints;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address','user_type',
        'city', 'postal_code', 'phone', 'country', 'provider_id',
        'email_verified_at', 'verification_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends=['user_avatar'];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function wishlist_product()
    {
        return $this->belongsToMany(Product::class,'wishlists');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function affiliate_user()
    {
        return $this->hasOne(AffiliateUser::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

  public function referral_code()
    {
        return $this->hasOne(Referal::class);
    }

    public function club_point()
    {
        return $this->hasOne(ClubPoint::class);
    }

    public function customer_package()
    {
        return $this->belongsTo(CustomerPackage::class);
    }

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getUserAvatarAttribute(){
        if($this->avatar_original){
            return asset($this->avatar_original);
        }else{
            return asset('image/user.png');
        }
    }

   
}
