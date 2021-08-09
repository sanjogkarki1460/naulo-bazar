@foreach (\App\Models\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
    @if ($homeCategory->category != null)
        <section id="deal">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="title text-center p-2 gry-bg">
                        <h3 class="heading-6 mb-0">
                            {{ __($homeCategory->category->title) }}
                        </h3>
                    </div>
                    <a href="{{ route('products.category', $homeCategory->category->slug) }}" class="btn btn-primary ">
                        View More
                    </a>
                </div>
                <div class="row mt-5">

                    <div class="product product-carousel owl-carousel owl-theme">
                        @foreach (filter_products(\App\Models\Product::where('published', 1)->where('category_id', $homeCategory->category->id))->latest()->limit(12)->get() as $key => $product)
                            @if ($product != null)
                                <div class="product-card">
                                    <a href="{{ route('single.product', $product->slug) }}" class="d-block">
                                        <div class="product-card-img">
                                            <figure>
                                                <img class="img-fit lazyload"
                                                     src="{{ asset('frontend/images/product-1.png') }}"
                                                     data-src="{{ asset($product->thumbnail_img) }}"
                                                     alt="{{ __($product->name) }}">
                                            </figure>
                                            @endif
                                        </div>

                                        <div class="product-card-detail">
                                            <div class="row">
                                                <div class="product-name mb-1 ml-2">
                                                    {{$product->name}}
                                                </div>
                                                <div class="star-rating star-rating-sm pl-2">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                            </div>
                                            <div class="product-price d-flex align-items-center justify-content-between">
                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <span class="product-price-act">
                                              {{ home_discounted_base_price($product->id) }}
                                            </span>
                                                    <span class="product-price-dis">
                                                <del>   {{ home_base_price($product->id) }}  </del>
                                            </span>
                                                @endif
                                            </div>
                                            @if (\App\Models\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Models\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                    {{ __('Club Point') }}:
                                                    <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                </div>
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach
