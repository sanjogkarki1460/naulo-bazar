@extends('backend.body')
@section('title','Settings')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Site Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="">Api</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Google Analytics</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin-dashboard')}}" class="btn btn-sm btn-round btn-outline-primary" title=""><i
                            class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                    </div>
                    <div class="body">
                        <form id="advanced-form" data-parsley-validate="" novalidate="" action="{{route('sites.update')}}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-file-image-o"></i> &nbsp;JSON file </span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="logo" class="custom-file-input"
                                                                id="inputGroupFile03">
                                                            <label class="custom-file-label" for="inputGroupFile03">Choose
                                                                Logo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @if(isset($setting->logo))

                                                    <img src="{{ asset('storage/setting/logo/'.$setting->logo) }}"
                                                        data-toggle="tooltip" data-placement="top" title="" alt="Logo"
                                                        class="rounded img-thumbnail" width="100px" height="100px"
                                                        data-original-title="Logo">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;VIEW ID</span>
                                        </div>
                                        <input type="text" name="sitetitle" value="{{ isset($setting->site_title) ? $setting->site_title : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>


                            </div>

                            <button type="submit" class="btn btn-outline-danger">Cancel</button>
                            <button style="float: right" type="submit" class="btn btn-outline-success">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>

@endsection
