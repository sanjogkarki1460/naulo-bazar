@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Invoices List</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dasboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Notification</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="">Add New</a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="table-responsive invoice_list mb-4">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">#</th>
                                    <th>Client</th>
                                    <th style="width: 50px;">Status</th>
                                    <th style="width: 110px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(auth()->user()->notifications)
                                @foreach (auth()->user()->notifications as $notification) 
                                <tr>
                                    <td>
                                        <span>{{$loop->iteration}}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avtar-pic w35 bg-red" data-toggle="tooltip" data-placement="top" title="Avatar Name"><span>SS</span></div>
                                            <div class="ml-3">
                                                <a href="page-invoices-detail.html" title="">Order</a>
                                                <p class="mb-0">Order Placed</p>
                                            </div>
                                        </div>
                                    </td>
                         
                                    <td><span class="badge badge-success ml-0 mr-0">Done</span></td>
                                    <td>
                                    <a href="{{route('notification.delete',$notification->id)}}" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip" data-placement="top"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                              
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


