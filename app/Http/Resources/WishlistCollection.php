<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WishlistCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => (integer) $data->id,
					 'product_id'=>(integer)$data->product->id,
                    'product' => [
                        'name' => $data->product->name,
                        'thumbnail_image' => $data->product->thumbnail_img,
                        'base_price' => (double) homeBasePrice($data->product->id),
                        'base_discounted_price' => (double) homeDiscountedBasePrice($data->product->id),
                        'unit' => $data->product->unit,
                        'rating' => (double) $data->product->rating,
						'slug' => $data->product->slug,
                        'links' => [
                            'details' => route('products.show', $data->product->slug),
                            'reviews' => route('api.reviews.index', $data->product->slug),
                            'related' => route('products.related', $data->product->slug),
                            'top_from_seller' => route('products.topFromSeller', $data->product->slug)
                        ]
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
