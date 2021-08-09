<style>
    .custom {
        width: 78px !important;
        color: black;
    }

    .custom:hover {
        color: black;
        background-color: grey;
    }

    .xzoom {
        height: 400px;
        width: 400px;
    }
</style>
<section id="product-detail">
    <div class="container">
        <div class="pt-5">
            {{-- @if(Auth::check())
            <form action="{{route('user.addtocart')}}" class="py-2 mb-2">
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="price" id="user_price" value="{{$product->price}}">
            @else
            <form action="{{route('addtocart',$product->id)}}" class="py-2 mb-2">
            @endif --}}
            <section class="breadcrumbs mb-3 ">
                <ul class="d-flex align-items-center">
                    <li><a href="#">Home</a></li>
                    @foreach($product->categories as $key => $value)

                        <li><span>{{$value->title}}</span></li>
                    @endforeach
                    <li><span>{{$product->title}}</span></li>
                    <li><span>{{$product->title}}</span></li>

                </ul>
            </section>
        </div>
        <?php
        $images = Storage::files('public/products/' . $product->slug . '/gallery/');
        ?>
        <div class="row py-4">
            <div class="col-md-4">
                <div class="xzoom-container">
                    <div class="default__zoom">
                        <div class="image__zoom">
                            @if(file_exists(public_path('storage/products/'.$product->slug.'/'.$product->image)))
                                <img class="xzoom" id="xzoom-fancy"
                                     src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                     xoriginal="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                     width="400px">
                            @else
                                <img class="xzoom" id="xzoom-fancy"
                                     src="{{asset('frontend/images/product-1.png')}}"
                                     xoriginal="{{asset('frontend/images/product-1.png')}}"
                                     width="400px">
                            @endif
                        </div>
                    </div>
                    <div class="xzoom-thumbs my-3">
                        @if(isset($images))
                            @foreach($images as $key => $value)
                                <a href="{{asset(str_replace("public","storage",$value))}}">
                                    <img class="xzoom-gallery " width="80px" height="80px"
                                         src="{{asset(str_replace("public","storage",$value))}}"
                                         xpreview="{{asset(str_replace("public","storage",$value))}}">
                                </a>
                            @endforeach
                        @endif
                        @if(file_exists(public_path('storage/products/'.$product->slug.'/'.$product->image)))
                            <a href="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}">
                                <img class="xzoom-gallery" width="80px" height="80px"
                                     src="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}"
                                     xpreview="{{asset('storage/products/'.$product->slug.'/'.$product->image)}}">
                            </a>
                        @else
                            <a href="{{asset('frontend/images/product-1.png')}}">
                                <img class="xzoom-gallery " width="80px" height="80px"
                                     src="{{asset('frontend/images/product-1.png')}}"
                                     xpreview="{{asset('frontend/images/product-1.png')}}">
                            </a>
                            <a href="http://smartbazaar.com.np/uploads/product/images/n/p/j/IMAGE.jpg">
                                <img class="xzoom-gallery " width="80px" height="80px"
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
                                <span class="bagde badge-primary px-2 "><a href="{{url('vendors')}}">
                                    {{$product->user->name}}</a>
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
                                            margin-left: 15px;"

                                    >
                                        <a data-href="{{asset('frontend/images/product-1.png')}}"
                                           xpreview="{{asset('frontend/images/product-1.png')}}"></a>
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
                    @php
                        $variation = $option_group->variation;
                        $parts = explode('/', $variation[0]->name);
                    @endphp
                    @for($i=0; $i<count($parts); $i++)
                        <div class="row mb-2 mt-2">
                            <div class="col">
                                <label for="size">{{ $parts[$i] }}</label>
                            </div>
                            @for($j=0; $j<count($variation); $j++)
                                @php
                                    $partsvalue = explode('/', $variation[$j]->value);
                                @endphp
                                <div class="col">

                                    <button type="button" value="{{ $partsvalue[$i] }}"
                                            onclick="addvariationarray('{{ $parts[$i] }}','{{ $partsvalue[$i] }}','{{ $variation[$j]->price }}')"
                                            class="btn custom product_variation  btn-outline-secondary">
                                        {{ $partsvalue[$i] }}</button>
                                </div>
                            @endfor

                        </div>
                    @endfor

                    <div class="buttons">
                        <button type="button" id="addtocart" class="btn btn-primary">
                            <span> Add To Cart <i class=""></i></span>
                        </button>
                        <a href="{{route('compare',$product->id)}}" class="btn btn-primary">Compare</a>
                        @if(Auth::check())
                            <a href="{{route('user.wishlist',$product->id)}}"
                               class="btn btn-default bg-dark btn-shadow text-white">
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
                                    Delivery Charge<br>
                                    @if(isset($option_group->delivery->charge))
                                        <small class="text-muted"> <span class="text-success mr-3"><i
                                                        class="fas fa-check"></i></span>Rs.{{$option_group->delivery->charge}}
                                        </small>
                                    @else
                                        <small class="text-muted"> <span class="text-danger mr-3"><i
                                                        class="fas fa-times"></i></span>Not Defined</small>
                                    @endif
                                </div>
                                <div class="home-delivery mb-3">
                                    Home Delivery<br>
                                    @if(isset($option_group->delivery->time))
                                        <small class="text-muted"> <span class="text-success mr-3"><i
                                                        class="fas fa-check"></i></span>{{$option_group->delivery->time}}
                                        </small>
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
                                        <span class="text-success mr-3"><i
                                                    class="fas fa-check"></i></span>{{$option_group->delivery->return_policy}}
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
                                                    class="fas fa-check"></i></span>{{$option_group->delivery->warrenty}}
                                        warranty</small>
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
    {{-- </form> --}}
</section>
@include('frontend.body.single-product.description')
@push('scripts')
    <script>
        $(document).ready(function (e) {
            let image = null;
            $('.xzoom-gallery').each(function (i, obj) {
                $(this).click(function (e) {
                    image = $(this).attr('src');
                    console.log(image);
                });

            });
            $('#addtocart').click(function (e) {
                let variation = null;
                let quantity = $('#quantity').val();
                $('.product_variation').each(function (i, obj) {
                    if ($(this).hasClass('active')) {
                        variation = $(this).prev('input').val();
                    }

                });


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: '{{route("addtocart",$product->id)}}',
                    method: 'get',
                    data: {quantity: quantity, variation: variation, image: image},
                    success: function (response) {
                        toastr.success(response.status);
                        // This will reload the page after a delay of 3 seconds
                        window.setTimeout(function () {
                            location.reload()
                        }, 1000)
                    },
                    error: function (response) {
                        $.each(response.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });


                    }
                })
            });
        });

        $(document).ready(function () {
            $('.colorvariation').each(function (i, obj) {
                var i = i + 1;
            })
            $('.circlevariation1').each(function (i, obj) {
                $(this).click(function () {
                    var i = i + 1;
                    $('.color' + i).show();
                })
            });
            $('.product-list').on('change', function () {

                $('.product-list').not(this).prop('checked', false);
                var test = $(this).closest("tr.options").find(".variation_price").val();
                const product_price = {{$product->price}};
                if ($(this).prop('checked') == true) {
                    $('#product_price').text("RS." + " " + test);
                    $('#user_price').val(test);
                } else {
                    $('#product_price').text("RS." + " " + product_price);
                    $('#user_price').val(product_price);
                }


            });
        })


    </script>

@endpush


@if($product->convertVariation($product->option_group))
    @push('scripts')
        <script>
            $(document).ready(function (e) {
                var count = {{count($product->convertVariation($product->option_group))}};
                // var array = {{json_encode($product->convertVariation($product->option_group))}};
                var price = null;
                for (i = 0; i < count; i++) {
                    $('.product_variation' + i + '').each(function (x, obj) {
                        $(this).click(function (e) {
                            $('.product_variation').removeClass('active');
                            var className = $(this).attr("class").split(' ')[1];
                            mr_val = $('.' + className).addClass('active');
                            variation = $(this).prev('input').val();
                            var price = jQuery.parseJSON(variation);
                            $('#product_price').text("RS." + " " + price.price);
                            $('#user_price').val(price.price);


                        });

                    });

                }

            });
        </script>


    @endpush
@endif

<script>

    function setSizeColor(button) {

        var property = document.getElementById(button);
        if (sizeCount == 0) {
            property.classList.remove("active");
            // property.style.backgroundColor = "#FFFFFF"
            sizeCount = 1;
        } else {
            property.classList.add("active");
            // property.style.backgroundColor = '#eb3f24'
            sizeCount = 0;
        }
    }

    var sizeCount = 1;

    function setSizeColor(button) {

        var property = document.getElementById(button);
        if (sizeCount == 0) {
            property.style.backgroundColor = "#FFFFFF"
            sizeCount = 1;
        } else {
            property.style.backgroundColor = '#eb3f24'
            sizeCount = 0;
        }
    }

    var storageCount = 1

    function setStorageColor(button) {
        var property = document.getElementById(button);
        if (storageCount == 0) {
            property.style.backgroundColor = "#FFFFFF"
            storageCount = 1;
        } else {
            property.style.backgroundColor = '#eb3f24'
            storageCount = 0;
        }
    }

    var ramCount = 1

    function setRamColor(button) {

        var property = document.getElementById(button);
        if (ramCount == 0) {
            property.style.backgroundColor = "#FFFFFF"
            ramCount = 1;
        } else {
            property.style.backgroundColor = '#eb3f24'
            ramCount = 0;
        }
    }


    var variationKey = [];
    var variationValue = [];

    function addvariationarray(variationkey, variationvalue, price) {


        // variationarray.push(variation);
        console.log(variationkey);
        console.log(variationvalue);
        console.log(price);
        // var numArray = [];
        $('#product_price').text("RS." + " " + price);
        $('#user_price').val(price);


        // if (variationKey.indexOf(variationkey) !== -1) {
        //     toastr.error('Alerady Exit');
        //     // variationValue.push(variationvalue);
        //
        // } else {
        //     variationKey.push(variationkey);
        //
        // }
        // // variationValue.push(variationvalue);
        // if (variationValue.indexOf(variationvalue) !== -1) {
        //
        //     toastr.error('Alerady Exit');
        // } else {
        //     variationValue.push(variationvalue);
        //
        // }
        // console.log(variationKey);
        // console.log(variationValue);
        // document.querySelector(".txt").innerHTML = numArray.join('');
    }

</script>

