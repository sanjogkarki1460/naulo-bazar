<!-- cart page section -->
<section id="cart-page">
    <div class="container mt-5">
        <div class="row ">
            <div class="col-md-8 mb-3">
                <div class="cart box-shadow ">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="mb-0 mr-3">Shopping cart</h4>
                        <small class=" badge badge-primary"> {{count($cart)}} items</small>
                    </div>
                    <div class="card-body cart-box">
                        <div class="cart-box--titles border-bottom d-flex align-items-center mb-3">
                            <div class=" font-weight-bold item">Item</div>
                            <div class=" font-weight-bold price">Price</div>
                            <div class=" font-weight-bold qty">Quantity</div>
                        </div>
                        <ul class="cart-box--item">
                            @foreach($cart as $key => $value)
                            <li class="cart-box--item_list d-flex border-bottom mb-3 py-3 ">
                                <div class="item">
                                    <div class="item-img">
                                        <figure>
                                            @if(file_exists(public_path('storage/products/'.$value->products->slug.'/thumbs/small_'.$value->products->image)))
                                            @if($value->image)
                                        <img src="{{$value->image}}" alt="Image"></a>
                                            @else
                                            <img src="{{asset('storage/products/'.$value->products->slug.'/thumbs'.'/small_'.$value->products->image)}}" alt="Image"></a>
                                            @endif
                                            @else
                                            <img src="{{asset('frontend/images/product-1.png')}}" alt="">
                                            @endif      
                                        </figure>
                                    </div>
                                    <div class="item-desc">
                                        <h6 class="">{{Illuminate\Support\Str::limit($value->products->title,45)}}</h6>
                                        
                                        @if($value->option_group != 'null')
                                        @foreach(json_decode($value->option_group) as $key => $variation)
                                        <p>{{ucfirst($key)}}: <span>{{$variation}}</span></p>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>
                                <div class="price">
                                    RS.{{$value->price}}
                                </div>
                                <div class="qty">
                                    <label for="quantity-cart"></label>
                                <input type="number" id="quantity-cart" value="{{$value->quantity}}" class="form-control">
                                <a href="{{route('user.deletecart',$value->id)}}"><i class="fas fa-times"></i></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cart-price_container box-shadow">
                    <div class="card-header">
                        <h4>Total Amount</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Item Subtotal</td>
                                <td>Rs.{{number_format($cart->sum('total_price'))}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge</td>
                                @if($cart->isNotEmpty())
                                    <td>Rs.{{$cart->first()->deliveryCharge($cart)}}</td>
                                @else
                                    <td>0</td>
                                @endif
                            </tr>
                            <tr class="border-top mt-3">
                                <td><strong>Estimate Total </strong><br>
                                    <small>tax calculated in checkout</small>
                                </td>
                                @if($cart->isNotEmpty())
                                <td>
                                  <strong> Rs.{{number_format($cart->sum('total_price')-$cart->first()->deliveryCharge($cart))}}</strong>
                                </td>
                                @else
                                <td><strong>0</strong></td>
                                @endif  

                            </tr>
                        </table>
                    <a href="{{route('checkout.address')}}" class="btn btn-primary d-inline-block float-right"> Checkout</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="apply-coupon box-shadow my-5 p-3">
                    <form action="">
                        <label for="coupon">Apply Coupon</label>
                        <input type="text" class="form-control" value="">
                        <button class="btn btn-primary float-right my-3">Apply Now</button>
                            <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>