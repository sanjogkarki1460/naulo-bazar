<div class="navbar-collapse offcanvas-collapse-cart">
    <button class="close-collapse btn btn-danger btn-sm  float-right">X</button>
    <div class="toolbar-section current" id="cart">
        <div class="table-responsive shopping-cart mb-0">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">
                            <div class="d-flex justify-content-between align-items-center">Products<a
                                    class="nav-link text-capitalize btn-link" href="{{route('cart')}}"><span
                                        class="btn-link">View Cart</span><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </th>
                    </tr>
                </thead>
                @if($cart)
                <tbody>
                    @foreach($cart as $key => $value)
                    <tr>
                        <td>
                            <div class="product-item"><a class="product-thumb" href="{{route('single.product',$value->product_id)}}">
                                @if(file_exists(public_path('storage/products/'.$value->products->slug.'/thumbs/small_'.$value->products->image)))
                                @if($value->image)
                                <img src="{{$value->image}}" alt="Image"></a>
                                @else
                                <img src="{{asset('storage/products/'.$value->products->slug.'/thumbs'.'/small_'.$value->products->image)}}" alt="Image"></a>
                                @endif
                                @else
                                <img src="{{asset('frontend/images/product-1.png')}}" alt="">
                                @endif  
                                <div class="product-info">
                                <h4 class="product-title"><a href="{{route('single.product',$value->id)}}">{{Illuminate\Support\Str::limit($value->products->title,20)}}</a></h4><span><em>Price:</em>
                                {{number_format($value->price)}}</span><span><em>Quantity:</em> {{$value->quantity}}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><a class="remove-from-cart" href="#"><i
                                    class="fas fa-close"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
        <hr class="mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="pr-2 py-1 text-sm">Subtotal: <span class="text-dark text-medium">Rs. {{$cart ? number_format($cart->sum('total_price'))  : '0'}} </span></div><a
                class="btn btn-sm btn-primary mb-0 mr-0" href="{{route('checkout.address')}}">Checkout</a>
        </div>
        
    </div>
</div>

