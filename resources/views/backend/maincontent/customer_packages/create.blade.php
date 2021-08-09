@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Create New Package</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Customer Packages</li>
                                <li class="breadcrumb-item active">Create Package</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row clearfix">

                    <div class="card">
                        <div class="body">

                            <!--Horizontal Form-->
                            <!--===================================================-->
                            <form class="form-horizontal" action="{{ route('customer_packages.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="body mt-2">
                                    <div class="header">
                                        <h2 class="badge badge-primary">Package Information</h2>
                                        <hr class="bg-blue">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Package Name</span>
                                                </div>
                                                <input type="text" placeholder="{{__('Name')}}" id="name"
                                                       name="name"
                                                       class="form-control"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-dollar"></i> &nbsp;Package Amount</span>
                                                </div>
                                                <input type="number" min="0" step="0.01"
                                                       placeholder="{{__('Amount')}}"
                                                       id="amount"
                                                       name="amount" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-image"></i> &nbsp;No. Of Product Upload</span>
                                                </div>
                                                <input type="number" min="0" step="1"
                                                       placeholder="{{__('Product Upload')}}"
                                                       id="product_upload" name="product_upload"
                                                       class="form-control"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-image"></i> &nbsp;Package Logo</span>
                                                </div>
                                                <input type="file" id="logo" name="logo" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel-footer text-right">
                                        <button class="btn btn-outline-success" type="submit">{{__('Save')}}</button>
                                    </div>
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
@endsection
