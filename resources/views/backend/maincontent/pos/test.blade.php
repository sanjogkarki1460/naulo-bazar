@extends('backend.body')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>User List</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Roles and Permisson</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Permission</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" data-toggle="modal"
                    data-target=".launch-pricing-modal" title="">Add New</a>
                </div>
            </div>
            <div class="modal fade launch-pricing-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Permission Create</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('permissions.create') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input name="title" type="text" class="form-control"
                                        placeholder="Enter Permisson's name here.." required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input name="display_name" type="text" class="form-control"
                                        placeholder="Display Name...." required>
                                </div>
                                <div class="input-group mb-3">
                                    <textarea name="description" class="form-control" id="" cols="15" rows="5" placeholder="Enter Description...."></textarea>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-5">
                <div class="card">

                    <div class="tab-content mt-0">
                        <div class="tab-pane active show" id="Users">
                            <div class="table-responsive">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-text-width"></i>
                                            &nbsp;Search</span>
                                    </div>
                                    <input class="form-control" type="text" name="keyword" placeholder="Search by Product Name/Barcode" onkeyup="filterProducts()">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row gutters-5">
                        <div class="col-xs-6">
                            <div class="">
                                <div class="form-group">
                                    <select name="poscategory" class="form-control demo-select2" onchange="filterProducts()">
                                        <option value="">All Categories</option>
                                        @foreach (\App\Models\Category::where('child_id','!=',0)->get() as $key => $category)
                                            <option value="category-{{ $category->id }}">{{ $category->title }}</option>
                                            @foreach (\App\Models\Category::where('parent_id',$category->id)->get() as $key => $subcategory)
                                                <option value="subcategory-{{ $subcategory->id }}">- {{ $subcategory->title }}</option>
                                                @foreach (\App\Models\Category::where('parent_id',$subcategory->id)->get()  as $key => $subsubcategory)
                                                    <option value="subsubcategory-{{ $subsubcategory->id }}">- - {{ $subsubcategory->title }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="">
                                <div class="form-group">
                                    <select name="brand" class="form-control demo-select2" onchange="filterProducts()">
                                        <option value="">All Brands</option>
                                        @foreach (\App\Models\Brand::all() as $key => $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="panel mb-3">
                    <div class="panel-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <select name="user_id" class="form-control pos-customer" onchange="getShippingAddress()">
                                    <option value="">Select a Customer</option>
                                    @foreach ($users as $key => $customer)
                                            <option value="{{ $customer->id }}" data-contact="{{ $customer->email }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-shrink-0 mar-lft" data-toggle="tooltip" data-placement="bottom" data-original-title="Shipping Address">
                                <button class="btn btn-primary" type="button" data-target="#new-customer" data-toggle="modal">
                                    <i class="fa fa-truck"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="new-customer" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
                        <div class="modal-content">
                            <div class="modal-header bord-btm">
                                <h4 class="modal-title h6">Shipping Address</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="email">{{__('Email')}}</label>
                                        <div class="col-sm-10">
                                            <input type="email" placeholder="{{__('Email')}}" id="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="address">{{__('Address')}}</label>
                                        <div class="col-sm-10">
                                            <textarea placeholder="{{__('Address')}}" id="address" name="address" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="email">{{__('Country')}}</label>
                                        <div class="col-sm-10">
                                            <select name="country" id="country" class="form-control selectpicker" required data-placeholder="{{__('Select country')}}">
                                                {{-- @foreach (\App\Country::all() as $key => $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="city">{{__('City')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{__('City')}}" id="city" name="city" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="postal_code">{{__('Postal code')}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" placeholder="{{__('Postal code')}}" id="postal_code" name="postal_code" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" row">
                                        <label class="col-sm-2 control-label" for="phone">{{__('Phone')}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" placeholder="{{__('Phone')}}" id="phone" name="phone" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-styled btn-base-1" data-dismiss="modal">Confirm</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="card">
                    @php
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                    @endphp
                    <div class="tab-content mt-0">
                        <div class="tab-pane active show" id="Users">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <thead>
                                        <tr>
                                            <th width="60%">{{__('Product')}}</th>
                                            <th width="15%">{{__('QTY')}}</th>
                                            <th>{{__('Price')}}</th>
                                            <th>{{__('Subtotal')}}</th>
                                            <th class="text-right">{{__('Remove')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="card-footer bord-top">
                            <table class="table mb-0 mar-no" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{__('Sub Total')}}</th>
                                        <th class="text-center">{{__('Total Tax')}}</th>
                                        <th class="text-center">{{__('Total Shipping')}}</th>
                                        <th class="text-center">{{__('Discount')}}</th>
                                        <th class="text-center">{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ ($subtotal) }}</td>
                                        <td class="text-center">{{ ($tax) }}</td>
                                        <td class="text-center">{{ ($shipping) }}</td>
                                        <td class="text-center">{{ (Session::get('pos_discount', 0)) }}</td>
                                        <td class="text-center">{{ ($subtotal+$tax+$shipping - Session::get('pos_discount', 0)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        var products = null;
        $(document).ready(function(){
            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
            $('#product-list').on('click','.product-card',function(){
                var id = $(this).data('id');
                $.get('{{ route('variants') }}', {id:id}, function(data){
                    if (data == 0) {
                        addToCart(id, null, 1);
                    }
                    else {
                        $('#variants').html(data);
                        $('#product-variation').modal('show');
                    }
                });
            });
            filterProducts();
        });

        function filterProducts()
        {
            var keyword = $('input[name=keyword]').val();
            var category = $('select[name=poscategory]').val();
            var brand = $('select[name=brand]').val();
            $.get('{{ route('pos.search_product') }}',{keyword:keyword, category:category, brand:brand}, function(data){
                products = data;
                $('#product-list').html(null);
                setProductList(data);
            });
        }

        function loadMoreProduct(){
            if(products != null && products.links.next != null){
                $.get(products.links.next,{}, function(data){
                    products = data;
                    setProductList(data);
                });
            }
        }

        function setProductList(data){
            for (var i = 0; i < data.data.length; i++) {
                $('#product-list').append('<div class="col-xs-3">' +
                    '<div class="panel product-card bg-gray" data-id="'+data.data[i].id+'" >'+
                        '<span class="price">'+data.data[i].price +'</span>'+
                        '<img src="'+ data.data[i].thumbnail_image +'" class="card-img-top img-fit" style="height: 80px">'+
                        '<div class="card-body">'+
                            '<div class="text-truncate-2 small" style="height: 28px">'+ data.data[i].name +'</div>'+
                        '</div>'+
                    '</div>'+
                '</div>');
            }
            if (data.links.next != null) {
                $('#load-more').find('.text-center').html('Load More');
            }
            else {
                $('#load-more').find('.text-center').html('Nothing more found');
            }
            $('[data-toggle="tooltip"]').tooltip();
        }

        function removeFromCart(key){
            $.post('{{ route('pos.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function addToCart(product_id, variant, quantity)
        {
            $.post('{{ route('pos.addToCart') }}',{_token:'{{ csrf_token() }}', product_id:product_id, variant:variant, quantity, quantity}, function(data){
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function addVariantProductToCart(id){
            var variant = $('input[name=variant]:checked').val();
            addToCart(id, variant, 1);
        }

        function updateQuantity(key){
            $.post('{{ route('pos.updateQuantity') }}',{_token:'{{ csrf_token() }}', key:key, quantity: $('#qty-'+key).val()}, function(data){
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setDiscount(){
            var discount = $('input[name=discount]').val();
            $.post('{{ route('pos.setDiscount') }}',{_token:'{{ csrf_token() }}', discount:discount}, function(data){
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setShipping(){
            var shipping = $('input[name=shipping]:checked').val();
            $.post('{{ route('pos.setShipping') }}',{_token:'{{ csrf_token() }}', shipping:shipping}, function(data){
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function getShippingAddress(){
            $.post('{{ route('pos.getShippingAddress') }}',{_token:'{{ csrf_token() }}', id:$('select[name=user_id]').val()}, function(data){
                if(data != null){
                    $('input[name=name]').val(data.name);
                    $('input[name=email]').val(data.email);
                    $('input[name=address]').val(data.address);
                    $('select[name=country]').val(data.country).change();
                    $('input[name=city]').val(data.city);
                    $('input[name=postal_code]').val(data.postal_code);
                    $('input[name=phone]').val(data.phone);
                }
            });
        }

        function submitOrder(payment_type){
            var user_id = $('select[name=user_id]').val();
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var address = $('input[name=address]').val();
            var country = $('select[name=country]').val();
            var city = $('input[name=city]').val();
            var postal_code = $('input[name=postal_code]').val();
            var phone = $('input[name=phone]').val();
            var shipping = $('input[name=shipping]:checked').val();
            var discount = $('input[name=discount]').val();
            $.post('{{ route('pos.order_place') }}',{_token:'{{ csrf_token() }}', user_id:user_id, name:name, email:email, address:address, country:country, postal_code:postal_code, phone:phone, payment_type:payment_type, shipping:shipping, discount:discount}, function(data){
                if(data == 1){
                    showFrontendAlert('success', 'Order Completed Successfully.');
                    location.reload();
                }
                else{
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
