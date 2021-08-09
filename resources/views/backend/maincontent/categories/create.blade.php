@extends('backend.body')

@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Categories Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Categories</li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ route('categories.create')}}"
                           class="btn btn-ro`unded btn-info pull-right">{{__('Add New Category')}}</a>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="card">
                        <div class="body">
                            <div class="header">
                                <h3 class="badge badge-primary p-3 font-12">{{__('Category Information')}}</h3>
                            </div>

                            <!--Horizontal Form-->
                            <!--===================================================-->
                            <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Name</span>
                                            </div>
                                            <input type="text" placeholder="{{__('Name')}}" id="name"
                                                   name="name" class="form-control"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Type</span>
                                            </div>
                                            <select name="digital" required
                                                    class="form-control demo-select2-placeholder">
                                                <option value="0">{{__('Physical')}}</option>
                                                <option value="1">{{__('Digital')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <hr class="bg-info">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Banner <small>(200x300)</small> </span>
                                            </div>
                                            <input type="file" id="banner" name="banner" class="form-control"
                                                   required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Icon <small>(32x32)</small> </span>
                                            </div>
                                            <input type="file" id="icon" name="icon" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <hr class="bg-info">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Title </span>
                                            </div>
                                            <input type="text" class="form-control" name="meta_title"
                                                   placeholder="{{__('Meta Title')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Description </span>
                                            </div>
                                            <textarea class="form-control summernote" name="meta_description"
                                                      aria-label="Default"></textarea>
                                        </div>
                                    </div>

                                    @if (\App\BusinessSetting::where('type', 'category_wise_commission')->first()->value == 1)
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                     <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                                 class="fa fa-percent"></i> &nbsp;Commission Rate </span>
                                                    <input type="number" min="0" step="0.01"
                                                           placeholder="{{__('Commission Rate')}}"
                                                           id="commision_rate" name="commision_rate"
                                                           class="form-control">
                                                    <div class="col-lg-2">
                                                        <option class="form-control">%</option>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                                <div class="panel-footer text-right">
                                    <button class="btn btn-outline-success" type="submit">{{__('Save')}}</button>
                                </div>
                            </form>
                            <!--=======s============================================-->
                            <!--End Horizontal Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
