@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Coupons List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Coupons</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Coupons List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{route('coupons.create')}}"
                           class="btn btn-sm btn-primary btn-round" title="">Add New
                            Coupon</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Uses Per Coupon</th>
                            <th width="10%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $key => $coupon)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>@if ($coupon->type == 'cart_base')
                                        Cart Base
                                    @elseif ($coupon->type == 'product_base')
                                        Product Base
                                    @endif</td>
                                <td>{{ date('d-m-Y', $coupon->start_date) }}</td>
                                <td>{{ date('d-m-Y', $coupon->end_date) }}</td>
                                <td>{{$coupon->uses_per_coupon}}</td>
                             
                                <td>
                                    <span class="content-right">
                                        <a href="{{ route('coupons.edit',base64_encode($coupon->id)) }}"
                                           class="btn btn-sm btn-outline-primary" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                                            <a href="{{ route('coupons.delete',base64_encode($coupon->id)) }}"
                                                               onclick="return confirm('Are you sure you want to delete this item?');"
                                                               class="btn btn-sm btn-outline-danger center-block"><i
                                                                        class="fa fa-trash"></i></a>
                                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
