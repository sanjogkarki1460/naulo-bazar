@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Shipping Configurations</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                <li class="breadcrumb-item"><a href="#">Shipping Configuration</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{url()->previous()}}"
                           class="btn btn-sm btn-primary btn-round" title="">Go Back</a>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="card col-md-6">
                        <div class="body">
                            <form action="{{ route('shipping_configuration.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="shipping_type">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="fancy-radio">
                                            <label>
                                                <input name="shipping_type" value="product_wise_shipping"
                                                       id="product-shipping"
                                                       type="radio"
                                                       checked=""><span><i></i>Product Wise Shipping Cost</span>
                                            </label>
                                        </div>
                                        <div class="fancy-radio">
                                            <label><input name="shipping_type" value="flat_rate"
                                                          type="radio"><span><i></i>Flate Rate Shipping Cost</span></label>
                                        </div>
                                        <div class="fancy-radio">
                                            <label><input name="shipping_type" id="seller-shippping"
                                                          value="seller_wise_shipping"
                                                          type="radio"><span><i></i>Seller Wise Flat Shipping Cost</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="header">
                            <h2 class="badge badge-primary">Note</h2>
                            <hr class="bg-blue">
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    1. Product Wise Shipping Cost calulation: Shipping cost is calculate by addition
                                    of
                                    each
                                    product shipping cost.
                                </li>
                                <li class="list-group-item">
                                    2. Flat Rate Shipping Cost calulation: How many products a customer purchase,
                                    doesn't
                                    matter. Shipping cost is fixed.
                                </li>
                                <li class="list-group-item">
                                    3. Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a
                                    customer
                                    purchase 2 product from two seller shipping cost is calculate by addition of
                                    each
                                    seller
                                    flat shipping cost.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="card col-md-6">
                        <div class="body">
                            <div class="header">
                                <h2 class="badge badge-primary">Flat Rate Cost</h2>
                                <hr class="bg-blue">
                            </div>
                            <form action="{{ route('shipping_configuration.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="flat_rate_shipping_cost">

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input class="form-control" type="text" name="flat_rate_shipping_cost"
                                               value="100">
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-md-6 mt-2">
                        <div class="body">
                            <div class="header">
                                <h2 class="badge badge-primary">Note</h2>
                                <hr class="bg-blue">
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="card col-md-6">
                        <div class="body">
                            <div class="header">
                                <h2 class="badge badge-primary">Shipping Cost For Admin Products</h2>
                                <hr class="bg-blue">
                            </div>
                            <form action="{{ route('shipping_configuration.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                <div class="panel-body">
                                    @csrf
                                    <input type="hidden" name="type" value="shipping_cost_admin">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <input class="form-control" type="text" name="flat_rate_shipping_cost"
                                                   value="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card col-md-6 mt-2">
                        <div class="body">
                            <div class="header">
                                <h2 class="badge badge-primary">Note</h2>
                                <hr class="bg-blue">
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection