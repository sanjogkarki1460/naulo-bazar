<!-- cart page section -->
<section id="cart-page">
 
    <div class="container mt-5">
        <div class="row ">
            <div class="col-md-8 mb-3">
                <div class="cart box-shadow ">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="mb-0 mr-3">Shopping cart</h4>
                        <small class=" badge badge-primary"> {{ session('cart') ? count(session('cart')->items) : "0"  }} items</small>
                    </div>
                    <div class="card-body cart-box">
                        <div class="cart-box--titles border-bottom d-flex align-items-center mb-3">
                            <div class=" font-weight-bold item">Item</div>
                            <div class=" font-weight-bold price">Price</div>
                            <div class=" font-weight-bold qty">Quantity</div>
                        </div>
                        <ul class="cart-box--item">
                            @if(session('cart'))
                            @foreach(session('cart')->items as $product)
                         
                            <li class="cart-box--item_list d-flex border-bottom mb-3 py-3 ">
                                <div class="item">
                                    <div class="item-img">
                                        <figure>
                                            @if(file_exists(public_path('storage/products/'.$product['items']->slug.'/thumbs/small_'.$product['items']->image)))
                                             <img src="{{asset('storage/products/'.$product['items']->slug.'/thumbs/small_'.$product['items']->image)}}" alt="">
                                            @else
                                            <img src="{{asset('frontend/images/product-1.png')}}" alt="">
                                            @endif
                                        </figure>
                                    </div>

                                    <div class="item-desc">
                                    <h6 class="">{{$product['items']->title}}</h6>
                                    @if(isset($product['variation']))
                                    @foreach($product['variation'] as $key => $value)
                                    <p>{{ucfirst($key)}}: <span>{{$value}}</span></p>
                                    @endforeach
                                    @else
                                    <p>{{$product['items']->short_content}}</p>
                                    @endif
                                    </div>
                                </div>
                                <div class="price">
                                    RS.{{$product['price']}}
                                </div>
                                <div class="qty position-relative">
                                <label for="quantity-cart"></label>
                                <input type="number" value="{{$product['qty']}}" id="quantity-cart" class="form-control">
                                <a href="{{route('guestcart.delete',$product['items']->id)}}"><i class="fas fa-times"></i></a>
                                </div>

                            </li>
                            @endforeach
                            @endif
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
                             
                                @php
                            
                                     $totalprice = 0;
                                     $delivery = 0;
                                        if(session('cart'))
                                        {
                                            foreach(session('cart')->items as $key => $value) {
                                            $totalprice+=$value['price'];
                                            $delivery+=$value['delivery_charge'];
                                        }
                                        
                                    }
                                @endphp
                               
                             
                                <td>{{ session('cart') ?  number_format($totalprice,2) : "0"}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge</td>
                                <td>{{session('cart') ? $delivery : "0"}}</td>
                            </tr>
                            <tr class="border-top mt-3">
                                <td><strong>Estimate Total </strong><br>
                                    <small>tax calculated in checkout</small>
                                </td>
                                <td>
                                  <strong>  {{ session('cart') ? number_format($totalprice+ $delivery,2 ) : "0"}} </strong>
                                </td>

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