@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Seller Edit</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Sellers</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ url()->previous()}}"
                           class="btn btn-rounded btn-info pull-right"><i class="fa fa-backward">Go Back</i></a>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="container col-md-6">
                        <div class="card">
                            <div class="body">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="badge badge-primary">Update Seller Information</h3>
                                    </div>

                                    <div class="container">
                                        <!--Horizontal Form-->
                                        <!--===================================================-->
                                        <form class="form-horizontal"
                                              action="{{ route('sellers.update', $seller->id) }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            <input name="_method" type="hidden" value="PATCH">
                                            @csrf
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"
                                                           for="name">{{__('Name')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="{{__('Name')}}" id="name"
                                                               name="name" class="form-control"
                                                               value="{{$seller->user->name}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"
                                                           for="email">{{__('Email Address')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="{{__('Email Address')}}"
                                                               id="email"
                                                               name="email"
                                                               class="form-control" value="{{$seller->user->email}}"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"
                                                           for="password">{{__('Password')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" placeholder="{{__('Password')}}"
                                                               id="password" name="password"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                                            </div>
                                        </form>
                                        <!--===================================================-->
                                        <!--End Horizontal Form-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
