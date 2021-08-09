@extends('frontend.body.checkout.index')
@section('checkout')
<div class="steps flex-sm-nowrap mb-5 py-5"><a class="step" href="{{route('checkout.address')}}">
                        <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>1. Address</h4></a><a class="step" href="{{route('checkout.shipping')}}">
                        <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>2. Shipping</h4></a><a class="step" href="{{route('checkout.payment')}}">
                        <h4 class="step-title"><i class="fa fa-check-circle check_circle"></i>3. Payment</h4></a><a class="step active" href="{{route('checkout.review')}}">
                        <h4 class="step-title">4. Review</h4></a>
</div>
@if(session()->get('checkoutaddress'))
      <div class="row pt-2 mt-3 mb-4">

                <div class="col-sm-6">
                    <h5>Shipping to:</h5>
                    <ul class="list-unstyled text-sm">
                        
                        @foreach(session()->get('checkoutaddress') as $key => $value)
                            @if($key != '_token')
                            <li><span class='text-muted'>{{ucfirst($key)}}: </span> {{$value}} </li>
                            @endif
                        @endforeach
                     
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h5>Payment method:</h5>
                    @if($shipping_method == 'cashondelivery')
                    <ul class="list-unstyled text-sm">
                    <li><span class='text-muted'>Cash on Delivery: </span>{{session()->get('checkoutaddress')['address1']}}</li>
                    </ul>
                    @else
                    <ul class="list-unstyled text-sm">
                        <li><span class='text-muted'>Paypal</span></li>
                    </ul>
                    @endif
                </div>
            </div>
@endif
<div class="row ">
    <div class="col-md-12">
        <div class="cart box-shadow ">
            <div class="card-header d-flex align-items-center">
                <h4 class="mb-0 mr-3">Order Items</h4>
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
                        <input type="number" id="quantity-cart" value="{{$value->quantity}}" class="form-control" disabled>
                        <a href="{{route('user.deletecart',$value->id)}}"><i class="fas fa-times"></i></a>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
       
</div>

            <hr class="pb-1">

            <div class="d-flex justify-content-between">
                @if($shipping_method == 'cashondelivery')
                <a class="btn btn-outline-secondary m-0" href="{{route('checkout.shipping')}}">Back</a>
                @else
                <a class="btn btn-outline-secondary m-0" href="{{route('checkout.payment')}}">Back</a>
                @endif
            <form action="{{route('checkout.complete')}}" method="post">
                @csrf
            <input type="hidden" value="{{$shipping_method}}" name="shipping_method">
                    <button class="btn btn-primary m-0" type="submit">Complete Order</button></div>
                </form>
            
                
@endsection