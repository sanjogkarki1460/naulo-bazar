
      <section id="product-detail">
        <div class="container">
            <div class="pt-5">
                @if(Auth::check())
                <form action="{{route('user.addtocart')}}" class="py-2 mb-2">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" name="price" id="user_price" value="{{$product->price}}">
                @else
                <form action="{{route('addtocart',$product->id)}}" class="py-2 mb-2">
                @endif
                <section class="breadcrumbs mb-3 ">
                    <ul class="d-flex align-items-center">
                        <li><a href="#">Home</a></li>
                         @foreach($product->category->getParentsAttribute() as $key => $value)
                               <li><span>{{$value->title}}</span></li>
                         @endforeach
                         <li><span>{{$product->category->title}}</span></li>
                         <li><span>{{$product->title}}</span></li>
                         
                    </ul>
        </section>
            </div>
             <?php
                $images = Storage::files('public/products/' . $product->slug . '/gallery/');
            ?>
            <div class="row py-4">
                <div class="col-md-4" >
                    <div class="xzoom-container">
                        <div class="default__zoom">
                            <div class="image__zoom">
                                @if(file_exists(public_path('storage/products/'.$product->slug.'/'.$product->image)))
                                <img class="xzoom" id="xzoom-fancy"
                                    src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                    xoriginal="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                    style="width: 400px;">
                                @else
                                <img class="xzoom" id="xzoom-fancy"
                                    src="{{asset('frontend/images/product-1.png')}}"
                                    xoriginal="{{asset('frontend/images/product-1.png')}}"
                                    style="width: 400px;">
                                @endif
                            </div>
                        </div>
                        <div class="xzoom-thumbs my-3">   
                            @if(isset($images))
                            @foreach($images as $key => $value)
                            <a href="{{asset(str_replace("public","storage",$value))}}">
                                <img class="xzoom-gallery " width="80px"
                                    src="{{asset(str_replace("public","storage",$value))}}"
                                    xpreview="{{asset(str_replace("public","storage",$value))}}">
                            </a>
                            @endforeach
                        @endif
                        @if(file_exists(public_path('storage/products/'.$product->slug.'/'.$product->image)))
                            <a href="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}">
                                <img class="xzoom-gallery " width="80px"
                                    src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                    xpreview="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}">
                            </a>
                            @else
                            <a href="{{asset('frontend/images/product-1.png')}}">
                                <img class="xzoom-gallery " width="80px"
                                    src="{{asset('frontend/images/product-1.png')}}"
                                    xpreview="{{asset('frontend/images/product-1.png')}}">
                            </a>
                            <a href="http://smartbazaar.com.np/uploads/product/images/n/p/j/IMAGE.jpg">
                                <img class="xzoom-gallery " width="80px"
                                    src="http://smartbazaar.com.np/uploads/product/images/n/p/j/small-IMAGE.jpg"
                                    xpreview="http://smartbazaar.com.np/uploads/product/images/n/p/j/medium-IMAGE.jpg">
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
               @if($product->convertColors($product->option_group))
                @foreach($product->convertColors($product->option_group) as $key => $value)
                <div class="col-md-4 colorvariation color{{$loop->iteration}}" style="display: none">
                    <div class="xzoom-container">
                        <div class="default__zoom">
                            <div class="image__zoom">
                                @if(file_exists(public_path($value->img)))
                                <img class="xzoom" id="xzoom-fancy"
                                    src="{{asset($value->img)}}"
                                    xoriginal="{{asset($value->img)}}"
                                    style="width: 400px;">
                                @else
                                <img class="xzoom" id="xzoom-fancy"
                                    src="{{asset('frontend/images/product-1.png')}}"
                                    xoriginal="{{asset('frontend/images/product-1.png')}}"
                                    style="width: 400px;">
                                @endif
                            </div>
                        </div>
                        <div class="xzoom-thumbs my-3">   
                            
                           @if(file_exists(public_path($value->img)))
                            <a href="{{asset($value->img)}}">
                                <img class="xzoom-gallery " width="80px"
                                    src="{{asset($value->img)}}"
                                    xpreview="{{asset($value->img)}}">
                            </a>
                            @else
                            <a href="{{asset('frontend/images/product-1.png')}}">
                                <img class="xzoom-gallery " width="80px"
                                    src="{{asset('frontend/images/product-1.png')}}"
                                    xpreview="{{asset('frontend/images/product-1.png')}}">
                            </a>
                            <a href="http://smartbazaar.com.np/uploads/product/images/n/p/j/IMAGE.jpg">
                                <img class="xzoom-gallery " width="80px"
                                    src="http://smartbazaar.com.np/uploads/product/images/n/p/j/small-IMAGE.jpg"
                                    xpreview="http://smartbazaar.com.np/uploads/product/images/n/p/j/medium-IMAGE.jpg">
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <div class="col-md-5 mb-3">
                    <div class="product-detail-short__info">
                        <div class="heading">
                            <h4>{{$product->title}}</h4>
                        </div>
                        <hr>
                        <div class="seller-info d-flex mb-3">
                            <div class="text-muted mr-3"> Sold By</div>
                            <p class="seller-info_name">
                                <span class="bagde badge-primary px-2 ">
                                    {{$product->user->name}}
                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="sku text-muted font-12">
                                <span class="">SKU</span>:<span>898989899</span>
                            </div>
                            <div class="stock-availability font-12">
                            @if($product->stock>0)
                                <span>Stock</span>: <span class="text-success">Available</span>
                            @else
                                <span>Stock</span>: <span class="text-danger">Out of stock</span>
                            @endif
                            </div>
                        </div>
                        <hr>
                       {{-- $product->convertVariation($product->option_group --}}
                        
                        <div class="d-flex align-items-center justify-content-between product-price">
                            <div class="d-flex  align-items-center">
                                <div class="product-price-dis mr-4">
                                    <div class="text-muted">RS. {{$product->previousPrice}}</div>
                                </div>
                                <h4 class="product-price-act text-primary text-lg" id="product_price">
                                    RS. {{$product->price}}
                                </h4>
                            </div>
                            <div class="badge badge-danger br-3">{{number_format($product->discount(),1)}}% less</div>
                        </div>
                  
                            <div class="form-group w-25">
                                <label for="quantity" class="font-weight-bold "> Quantity</label>
                                <input type="number" min="1" width="100px" value="1" class="form-control"
                                    name="quantity" id="quantity">
                            </div>
                            @if($product->convertColors($product->option_group))
                            <div class="form-group">
                                <label for="quantity" class="font-weight-bold "> Color Available</label>
                                <div id="block-container" style="  display: flex;">
                                @foreach($product->convertColors($product->option_group)  as $key => $value)
                                    <div class="circle circlevariation{{$loop->iteration}}" style=" height: 30px;
                                        width: 30px;
                                        background-color: #{{$value->color}};
                                        border-radius: 50%;
                                        border:1.5px solid black;
                                        margin-left: 15px;">
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div id="block-container" style="  display: flex;">
                                @foreach($product->convertColors($product->option_group)  as $key => $value)
                                {{-- <img class="xzoom-gallery " width="80px"
                                src="{{asset('storage/products/'.$product->slug.'/'.$value->color.'/thumbs/'.$value->color.'/'.'small_'.$product->image)}}"
                                xpreview="{{asset($value->img)}}"> --}}
                                @if(file_exists(public_path($value->img)))
                                <a href="{{asset($value->img)}}">
                                    <img class="xzoom-gallery " width="80px"
                                        src="{{asset($value->img)}}"
                                        xpreview="{{asset($value->img)}}">
                                </a>
                                @else
                               
                                <a href="http://smartbazaar.com.np/uploads/product/images/n/p/j/IMAGE.jpg">
                                    <img class="xzoom-gallery " width="80px"
                                        src="http://smartbazaar.com.np/uploads/product/images/n/p/j/small-IMAGE.jpg"
                                        xpreview="http://smartbazaar.com.np/uploads/product/images/n/p/j/medium-IMAGE.jpg">
                                </a>
                                @endif
                                @endforeach
                            </div>
                            </div>
                            @endif

                            {{-- @if($product->convertVariation($product->option_group))
                            <input type="hidden" name="check_variation" value="variation_available">
                            <label for="quantity" class="font-weight-bold ">Variation Available</label>
                            <table class="table table-bordered">
                            @foreach($product->convertVariation($product->option_group)  as $key => $value)
                            
                                @if($loop->first)
                                <thead>
                                    <tr>
                                        @foreach($value as $key=>$variation)    
                                        @if($loop->first)
                                        <th>Number</th>
                                        @endif
                                        @if($key != 'price')
                                        <th>{{ucfirst($key)}}</th>
                                        @endif
                                        @if($loop->last)
                                        <th>Select</th>
                                        @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                @endif
                                <tbody>
                                    <tr class="options">
                                        <th scope="row">{{$loop->iteration}}</th>
                                        @foreach($value as $key=>$variation)
                                        @if($key == 'price')
                                             <input type="hidden" class="variation_price" value="{{$variation}}">
                                        @endif
                                        @if($key != 'price')
                                        <td>{{$variation}}</td>
                                        @endif
                                        @endforeach
                                        <td style="position: relative;"> <input class="form-check-input product-list" name="variation" type="checkbox"
                                            value="{{json_encode($value)}}" style="top: 41%;
                                            left: 68%;"></td>
                                      </tr>
                                </tbody>
                            @endforeach
                        </table>
                            @endif --}}
                            @if($product->convertVariation($product->option_group))
                            @foreach(head($product->convertVariation($product->option_group)) as $first => $value)
                                <div class="row">
                                    @if($first != 'price')
                                    <div class="col-sm-2">{{ucfirst($first)}}</div>
                                   
                                    <div class="col-sm-10">
                                    <div>Int</div> 
                                    @endif
                                <div class="sizeBox">
                                   
                                  @foreach($product->convertVariation($product->option_group) as $key => $variation)
                                        @if($first == 'price')
                                             <input type="hidden" class="variation_price" value="{{$product->convertVariation($product->option_group)[$key][$first]}}">
                                        @endif
                                        @if($first != 'price')
                                        <span class="product_variation{{$key}}">{{$product->convertVariation($product->option_group)[$key][$first]}}</span>
                                        @endif
                                  @endforeach
                                </div>
                                </div> 
                                </div>
                        
                            @endforeach
                            @endif
                      
                        <div class="buttons">
                            <button class="btn btn-primary">
                                <span> Add To Cart <i class=""></i></span>
                            </button>
                             <a href="{{route('compare',$product->id)}}" class="btn btn-primary">Compare</a>
                             @if(Auth::check())
                            <a href="{{route('user.wishlist',$product->id)}}" class="btn btn-default bg-dark btn-shadow text-white">
                                <span> Add to Wishlist </span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product-detail-delivery__info">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5>Delivery Option</h5>
                            </div>
                            
                            <div class="card-body">
                                <div class="delilvery-option">
                                    <div class="home-delivery mb-3">
                                        Home Delivery<br>
                                        @if(isset($option_group->delivery->time))
                                        <small class="text-muted"> <span class="text-success mr-3"><i
                                                    class="fas fa-check"></i></span>{{$option_group->delivery->time}}</small>
                                        @else
                                        <small class="text-muted"> <span class="text-danger mr-3"><i
                                            class="fas fa-times"></i></span>Not Defined</small>
                                        @endif
                                    </div>
                                    <div class="cash-delivery">
                                        Cash On Delivery<br>
                                        @if(isset($option_group->delivery->cashondelivery))
                                        <small class="text-muted"><span class="text-success mr-3"><i
                                                    class="fas fa-check"></i></span>Available</small>
                                        @else
                                        <small class="text-muted"><span class="text-danger mr-3"><i
                                                    class="fas fa-times"></i></span>Not Available</small>
                                        @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="return-policy mb-3">
                                    <p>Return Policy </p>
                                    <small class="text-muted">
                                        @if(isset($option_group->delivery->return_policy))
                                        <span class="text-success mr-3"><i class="fas fa-check"></i></span>{{$option_group->delivery->return_policy}}
                                        return Policy</small>
                                        @else
                                        <span class="text-danger mr-3"><i class="fas fa-times"></i></span>
                                        No Return Policy</small>
                                        @endif
                                </div>
                                <div class="warranty">
                                    <p>Warranty</p>
                                    @if(isset($option_group->delivery->warrenty))
                                     <small class="text-muted"><span class="text-success mr-3"><i
                                                class="fas fa-check"></i></span>{{$option_group->delivery->warrenty}} warranty</small>
                                    @else
                                    <small class="text-muted"><span class="text-danger mr-3"><i
                                                class="fas fa-times"></i></span> No warranty available </small><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    </section>
@include('frontend.body.single-product.description')
@push('scripts')
<script>
    $(document).ready(function(e){
        
    })
    $(document).ready(function(){
        $('.colorvariation').each(function(i, obj) {
                var i = i+1;
                
              
        })
        $('.circlevariation1').each(function(i,obj){
           $(this).click(function(){
                var i = i+1;
              $('.color'+i).show();
           })
        });
        $('.product-list').on('change', function() {
        
        $('.product-list').not(this).prop('checked', false);  
        var test = $(this).closest("tr.options").find(".variation_price").val();
        const product_price = {{$product->price}};
            if ($(this).prop('checked')==true){ 
                $('#product_price').text("RS."+" "+test);
                $('#user_price').val(test);
        }
        else
        {
            $('#product_price').text("RS."+" "+product_price);
            $('#user_price').val(product_price);
        }
       
        
      
      
        });
    })


</script>

@endpush