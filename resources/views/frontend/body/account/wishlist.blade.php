@extends('frontend.body.account.index')
@section('account')
<div class="@if(Auth::check()) col-md-8 @else col-md-12 @endif ">
            <div class="mb-5">
                <div class="pt-5 mt-2 hidden-lg-up"></div>
                <!-- Wishlist Table-->
                <div class="cart  ">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="mb-0 mr-3">Wishlist</h4>
                        <small class=" badge badge-primary"> 2 items</small>
                    </div>
                    <div class="card-body cart-box">
                        <div class="cart-box--titles border-bottom d-flex align-items-center mb-3">
                            <div class=" font-weight-bold item">Item</div>
                            <div class=" font-weight-bold price">Price</div>
                            <div class=" font-weight-bold qty">Remove</div>
                        </div>
                        <ul class="cart-box--item">
                            @if($wishlist)
                            @foreach($wishlist as $key => $value)
                            <li class="cart-box--item_list d-flex border-bottom mb-3 py-3">
                                <div class="item">
                                    <div class="item-img">
                                        <figure>
                                            @if(file_exists(public_path('storage/products/'.$value->product->slug.'/thumbs/small_'.$value->product->image)))
                                            <img src="{{asset('storage/products/'.$value->product->slug.'/thumbs'.'/small_'.$value->product->image)}}" alt="Image"></a>
                                            @else
                                            <img src="{{asset('frontend/images/product-1.png')}}" alt="">
                                            @endif 
                                        </figure>
                                    </div>

                                    <div class="item-desc">
                                    <h6 class="">{{$value->product->title}}</h6>
                                        <p><span>{{$value->product->short_content}}</span></p>
                                    </div>
                                </div>
                                <div class="price">
                                    RS.{{$value->product->price}}
                                </div>
                                <div class="qty">
                                   <button  class="btn btn-default text-danger ">
                                       X</button>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="inform_me" checked>
                    <label class="custom-control-label" for="inform_me">Inform me when item from my wishlist is available</label>
                </div>
            </div>
        </div>
@endsection