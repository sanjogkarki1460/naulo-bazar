@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 mb-5">
                        <h2>Customer Package Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Customer Packages</li>
                                <li class="breadcrumb-item active">All Packages</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ route('customer_packages.create')}}"
                           class="btn btn-rounded btn-info pull-right">{{__('Add New Package')}}</a>
                    </div>

                </div>
                <div class="row clearfix">
                    @foreach ($customer_packages as $key => $customer_package)
                        <div class="col-lg-3 col-md-6">
                            <a class="card" href="javascript:void(0)">
                                <div class="body text-center">
                                    <img class="img-thumbnail rounded-circle" src="{{ asset($customer_package->logo) }}"
                                         alt="">
                                    <h6 class="mt-3">{{$customer_package->name}}</h6>
                                    <div class="text-center text-muted">{{single_price($customer_package->amount)}}</div>
                                    <div class="heading">
                                        <p>Product Upload:<span
                                                    class="font-weight-bold">{{$customer_package->product_upload}} </span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
