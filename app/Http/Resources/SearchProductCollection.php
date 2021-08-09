<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'name' => $data->name,
                    'thumbnail_image' => $data->thumbnail_img,
                    'base_price' => (double) homeBasePrice($data->id),
                    'base_discounted_price' => (double) homeDiscountedBasePrice($data->id),
                    'rating' => (double) $data->rating,
                    'slug' => $data->slug,
                    'links' => [
                        'details' => route('products.show', $data->slug),
                        'reviews' => route('api.reviews.index', $data->slug),
                        'related' => route('products.related', $data->slug),
                        'top_from_seller' => route('products.topFromSeller', $data->slug)
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
