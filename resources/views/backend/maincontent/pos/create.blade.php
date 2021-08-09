@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Order</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/pos') }}">Pos</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ route('categories.list') }}" class="btn btn-sm btn-primary" title=""><i class="fa fa-list"></i> List Order</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-12">
                    <form method="POST" action="{{ route('pos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">User</span>
                                            </div>
                                            <input type="text" class="form-control" name="user_name"
                                                   placeholder="User Name"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Price</span>
                                            </div>
                                            <input type="text" class="form-control" name="total_price"
                                                   placeholder="Total Price"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="default" selected>Choose Order Status</option>
                                                <option value="0"   class="text-info font-weight-bold">Pending</option>
                                                <option value="1"   class="text-info font-weight-bold">On Process</option>
                                                <option value="2"   class="text-info font-weight-bold">Delivered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select name="payment_method" id="payment_method" class="form-control">
                                                <option value="default" selected>Choose Payment Method</option>
                                                <option value="cash_delivery"   class="text-info font-weight-bold">Cash Delivery</option>
                                                <option value="esewa"   class="text-info font-weight-bold">Esewa</option>
                                                <option value="paypal"   class="text-info font-weight-bold">Paypal</option>
                                                <option value="other"   class="text-info font-weight-bold">other</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="product_detail">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Product</span>
                                            </div>
                                            <select name="product_id[]" id="" class="form-control">
                                                <option value="" selected>Choose Product </option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}"  class="text-info font-weight-bold">{{$product->title}}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" class="form-control" name="quantity[]"
                                                   placeholder="Quantity"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tax</span>
                                            </div>

                                            <input type="number" class="form-control" name="tax"
                                                   placeholder="Tax"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="product_result">

                                </div>
                                <div class="col-md-12">
                                    <a href="" id="addmore" class="btn btn-outline-success">Add more</a>
                                </div>
                                <br>
                                <div class="row" id="shipping_detail">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Shipping Detail</span>
                                            </div>
                                            <input type="text" class="form-control" name="shipping_details[]"
                                                   placeholder="Shipping Address"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="shipping_result">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" id="addmore_shipping" class="btn btn-outline-success">Add more</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row" id="billing_detail">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Billing Detail</span>
                                            </div>
                                            <input type="text" class="form-control" name="billing_details[]"
                                                   placeholder="Billing Details"
                                                   aria-label="Title"
                                                   aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="billing_result">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" id="addmore_billing" class="btn btn-outline-success">Add more</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('poin-of-sales.index') }}" class="btn btn-danger">Cancel</a>
                                <span class="float-right">
                            <button type="submit" name="submit" class="btn btn-success" value="save">Save</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#addmore').click(function(e){
                e.preventDefault();
                var $product = $('#product_detail').html();
                $('#product_result').append($product);
            });
            $('#addmore_shipping').click(function(e)
            {
                e.preventDefault();
                var $shipping = $('#shipping_detail').html();
                $('#shipping_result').append($shipping);
            });
            $('#addmore_billing').click(function(e)
            {
                e.preventDefault();
                var $billing = $('#billing_detail').html();
                $('#billing_result').append($billing);
            });

        });
    </script>
@endpush
