<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'name' => $data->name,
					'slug' => $data->slug,
                    'user' => [
                        'name' => $data->user->name ?? '',
                        'email' => $data->user->email ?? '',
                        'avatar' => $data->user->avatar ?? '' ,
                        'avatar_original' => $data->user->avatar_original ?? '',
                    ],
                    'logo' => $data->logo,
                    'sliders' => json_decode($data->sliders),
                    'address' => $data->address,
                    'facebook' => $data->facebook,
                    'google' => $data->google,
                    'twitter' => $data->twitter,
                    'youtube' => $data->youtube,
                    'instagram' => $data->instagram,
                    'links' => [
                        'featured' => route('shops.featuredProducts', $data->slug),
                        'top' => route('shops.topSellingProducts',  $data->slug),
                        'new' => route('shops.newProducts', $data->slug),
                        'all' => route('shops.allProducts', $data->slug),
                        'brands' => route('shops.brands', $data->slug)
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
}
