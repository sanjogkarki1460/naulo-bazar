@extends('backend.body')

@section('body')



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Sub-Category Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Categories</li>
                                <li class="breadcrumb-item">Sub-Categories</li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <br>
                <div class="row clearfix">
                    <div class="card">
                        <div class="body container col-md-6">
                            <div class="header">
                                <h3 class="badge badge-primary p-3 font-12">{{__('Sub-Category Information')}}</h3>
                            </div>

                            <!--Horizontal Form-->
                            <form class="form-horizontal" action="{{ route('subcategories.update', $subcategory->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PATCH">
                            @csrf

                            <!--Horizontal Form-->
                                <!--===================================================-->

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Name</span>
                                    </div>
                                    <input type="text" placeholder="{{__('Name')}}" id="name" name="name"
                                           class="form-control"
                                           value="{{$subcategory->name}}" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Category</span>
                                    </div>
                                    <select name="category_id" required class="form-control demo-select2">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" <?php if ($subcategory->category_id == $category->id) echo "selected";?> >{{__($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Slug</span>
                                    </div>
                                    <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug"
                                           value="{{ $subcategory->slug }}" class="form-control">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Meta Title</span>
                                    </div>

                                    <input type="text" class="form-control" name="meta_title"
                                           value="{{ $subcategory->meta_title }}" placeholder="{{__('Meta Title')}}">

                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Description</span>
                                    </div>
                                    <textarea name="meta_description" rows="8"
                                              class="form-control">{{ $subcategory->meta_description }}</textarea>
                                </div>

                                <div class="panel-footer text-right">
                                    <button class="btn btn-outline-success"
                                            type="submit">{{__('Save')}}</button>
                                </div>


                            </form>
                            <!--===================================================-->
                            <!--End Horizontal Form-->
                        </div>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End Horizontal Form-->
        </div>
    </div>

@endsection
