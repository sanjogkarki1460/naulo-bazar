@extends('backend.body')

@section('body')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Seller Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Sellers</li>
                                <li class="breadcrumb-item active">Create New Seller</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <div class="row clearfix">
                    <div class="container col-md-6">
                        <div class="card">
                            <div class="body">

                                <div class="header">
                                    <h5 class="badge badge-primary p-3">Seller Information</h5>
                                </div>
                                <!--Horizontal Form-->
                                <!--===================================================-->
                                <form class="form-horizontal" action="{{ route('sellers.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label" for="name">{{__('Name')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{__('Name')}}" id="name"
                                                       name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label"
                                                   for="email">{{__('Email Address')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{__('Email Address')}}" id="email"
                                                       name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label"
                                                   for="password">{{__('Password')}}</label>
                                            <div class="col-sm-9">
                                                <input type="password" placeholder="{{__('Password')}}"
                                                       id="password" name="password" class="form-control" required>
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

@endsection
