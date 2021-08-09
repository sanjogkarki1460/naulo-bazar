<?php
    
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\SubCategory;
    
class CategoryCollection extends ResourceCollection
 {
        public function toArray($request)
        {
            return [
                'data' => $this->collection->map(function ($data) {
                    return [
                        'name' => $data->name,
                        'banner' => $data->banner,
                        'icon' => $data->icon,
                        'slug' => $data->slug,
                        // 'brands' => brandsOfCategory($data->id),
                        'links' => [
                            'products' => route('api.products.category', $data->slug),
                            'sub_categories' => route('subCategories.index', $data->slug)
                        ],
						'sub_categories' => $data->subCategories,                 ];
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
    }
