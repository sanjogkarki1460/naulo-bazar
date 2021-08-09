<?php

namespace App\Http\Resources;

use App\Models\ReviewProduct;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\SubCategory;

use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductDetailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
            
                return [
                    'id' => (integer)$data->id,
                    'name' => $data->name,
                    'added_by' => $data->added_by,
                    'user' => 
                    [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => $data->user->avatar_original,
                        'shop_name' => $data->added_by == 'admin' ? '' : $data->user->shop->name,
                        'shop_logo' => $data->added_by == 'admin' ? '' : $data->user->shop->logo,
                        'shop_link' => $data->added_by == 'admin' ? '' : route('shops.info', $data->user->shop->slug)
                    ],
                    'category' => 
                    [
                        'name' => $data->category->name,
                        'banner' => $data->category->banner,
                        'icon' => $data->category->icon,
                        'links' => [
                            'products' => route('api.products.category', $data->category->slug),
                            'sub_categories' => route('subCategories.index', $data->category->slug)
                        ]
                    ],
                    'sub_category' => [
                        'name' => $data->subCategory->name ?? 'N/A',
                        'links' => 
                        [
                            'products' => route('products.subCategory', $data->subCategory->slug ?? 'N/A')
                        ]
                    ],
                    'brand' => 
                    [
                        'name' => $data->brand->name ?? 'N/A',
                        'logo' => $data->brand->logo ?? 'N/A',
                        'links' => 
                        [
                            'products' => route('api.products.brand', $data->brand->slug ?? 'N/A')
                        ]
                    ],
                    'variations'=>$this->convertVariation($data->stocks,$data->attributes,$data->slug),
                    'photos' => json_decode($data->photos),
                    'thumbnail_image' => $data->thumbnail_img,
                    'featured_image' => $data->featured_img,
                    'flash_deal_image' => $data->flash_deal_img,
                    'tags' => explode(',', $data->tags),
                    'price_lower' => (double)explode('-', homeDiscountedPrice($data->id))[0],
                    'price_higher' => (double)explode('-', homeDiscountedPrice($data->id))[1],
                    'choice_options' => $this->convertToChoiceOptions(json_decode($data->choice_options)),
                    'colors' => json_decode($data->colors),
                    'todays_deal' => (integer)$data->todays_deal,
                    'featured' => (integer)$data->featured,
                    'current_stock' => (integer)$data->current_stock,
                    'unit' => $data->unit,
                    'discount' => (double)$data->discount,
                    'discount_type' => $data->discount_type,
                    'tax' => (double)$data->tax,
                    'tax_type' => $data->tax_type,
                    'shipping_type' => $data->shipping_type,
                    'shipping_cost' => (double)$data->shipping_cost,
                    'number_of_sales' => (integer)$data->num_of_sale,
                    'rating' => (double)$data->rating,
                    'rating_count' => (integer)ReviewProduct::where(['product_id' => $data->id])->count(),
                    'description' => $data->description,
                    'links' =>
                    [
                        'reviews' => route('api.reviews.index', $data->id),
                        'related' => new ProductCollection(Product::where('subcategory_id', $data->subcategory_id)->where('id', '!=', $data->id)->limit(10)->get()),
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }

    protected function convertToChoiceOptions($data)
    {
        
        $result = array();
        foreach ($data as $key => $choice) 
        {
         
            $item['name'] = $choice->attribute_id;
            $item['title'] = Attribute::find($choice->attribute_id)->name;
            $item['options'] = $choice->values;
           
            array_push($result, $item);
        }
        return $result;
    }

    protected function convertVariation($data,$attributes,$slug)
    {
       $attributes = json_decode($attributes);
       
      
        $subset = $data->map(function ($data) {
            return collect($data->toArray())
                ->only(['image','variant','sku','qty','price'])
                ->all();
        });
        $result = array();
        foreach($attributes as $attribute)
        {
            $item = Attribute::find($attribute)->name;
            array_push($result,$item);
        }
        
        foreach($subset as $key=>$set)
        {
           
            $path = 'uploads/products/variation/'.$slug.'/'.$set['variant'];
           
            if(file_exists(public_path($path)))
            {
                $images = File::allFiles(public_path($path));
                $array_image = array();
                foreach($images as $image)
                {
                    if (strpos($image, 'thumb_') !== false) {
                        $array_image['thumb'][] = $path.'/'.$image->getRelativePathname();
                    }
                    else{
                        $array_image['full_image'][] = $path.'/'.$image->getRelativePathname();
                    }
                   
                }
                
                $set['images'] = $array_image;
            }
           
            $variant = $set['variant'];
            $values = explode("-",$variant);
			
			$data = array_merge($result,$values);
           
            $data = array_merge($set, $data);
         
            $subset->put($key,$data);
           
            
        }
     
        return $subset;
    }

}
