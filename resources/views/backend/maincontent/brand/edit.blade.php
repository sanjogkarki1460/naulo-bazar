@extends('backend.body')

@section('body')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Add Brand</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Brand</li>
                                <li class="breadcrumb-item active">All Brands</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <br>

                <div class="col-md-6 container">
                    <div class="card">
                        <div class="body">
                            <div class="body mt-2">
                                <div class="header">
                                    <h2 class="badge badge-primary">Brand Information</h2>
                                    <hr class="bg-blue">
                                </div>

                                <form class="form-horizontal" action="{{ route('brands.update', $brand->id) }}"
                                      method="POST" enctype="multipart/form-data">
                                    <input name="_method" type="hidden" value="PATCH">
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Brand Name</span>
                                            </div>
                                            <input type="text" placeholder="{{__('Name')}}" id="name" name="name"
                                                   class="form-control" required value="{{ $brand->name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Brand Logo</span>
                                            </div>

                                            <input type="file" id="logo" name="logo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Title</span>
                                            </div>
                                            <input type="text" class="form-control" name="meta_title"
                                                   value="{{ $brand->meta_title }}" placeholder="{{__('Meta Title')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Description</span>
                                            </div>
                                            <textarea name="meta_description" rows="8"
                                                      class="form-control">{{ $brand->meta_description }}</textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Slug</span>
                                            </div>
                                            <input type="text" placeholder="{{__('Slug')}}" id="slug"
                                                   name="slug" value="{{ $brand->slug }}"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="panel-footer text-right">
                                        <button class="btn btn-outline-dark"
                                                type="submit">{{__('Save')}}</button>
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


    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Brand Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{__('Logo')}} <small>(120x80)</small></label>
                    <div class="col-sm-10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Meta Title')}}</label>
                    <div class="col-sm-10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Description')}}</label>
                    <div class="col-sm-10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Slug')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug" value="{{ $brand->slug }}"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>

@endsection
