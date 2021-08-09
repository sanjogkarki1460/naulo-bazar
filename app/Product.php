<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'added_by', 'user_id', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'video_provider', 'video_link', 'unit_price',
        'purchase_price', 'unit', 'slug', 'colors', 'choice_options', 'variations', 'current_stock'
    ];

    protected $with=['reviews'];

    protected $appends=['thumbnail','rating','main_image','selling_price'];

    public function orders(){
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function wishlist_user(){
        return $this->hasMany(User::class,'wishlists');
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }


    public function getThumbnailAttribute(){
        if($this->thumbnail_img){
            return asset($this->thumbnail_img);
        }else{
            return asset('image/no-image.png');
        }
    }

    public function getSellingPriceAttribute(){
        if($this->discount>0 || $this->discount != null){
            if($this->discount_type == 'amount'){
                return (int) $this->unit_price - $this->discount;
            }else{
                $price = $this->unit_price * $this->discount/ 100;
                return (int) $this->unit_price-$price;
            }
            
        }else{
            return (int) $this->unit_price;
        }
    }

    public function getRatingAttribute(){
        $reviews = $this->reviews;
        $rating=0;
        if($reviews->count()>0){
            foreach ($reviews as $review) {
                $rating += $review->rating;
             }
             $rate= $rating/$reviews->count();
             return round($rate,1);
        }
       return $rating;
       
    }
    public function getMainImageAttribute($value) {
        $images= json_decode($this->photos);
        
        foreach($images as $image){
            $items[] = asset($image);
        }
        return $items;
      }

}
