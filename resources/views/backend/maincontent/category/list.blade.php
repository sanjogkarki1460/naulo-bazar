@extends('backend.body')
@section('title','Categories')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}"/>
@endpush
@section('body')
    <div id="main-content">


        <?php
        function displayList($list)
        {
        ?>
        <ol class="dd-list">
            <?php

            foreach ($list as $item):
            ?>
            <li class="dd-item dd3-item" data-id="{{ $item->id }} ">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <b>{{ $item->title }}</b>&nbsp;|&nbsp;
                    <small>
                        <i>
                            @if($item->top == 1)
                                <span class="badge badge-success mr-0 ml-0" style="font-size: 7px;">Displayed</span>
                            @endif
                            @if($item->featured == 1)
                                <span class="badge badge-info mr-0 ml-0" style="font-size: 7px;">Featured</span>
                            @else
                                <span class="badge badge-danger mr-0 ml-0" style="font-size: 7px;">Not Featured</span>
                            @endif

                            @if($item->digital == 1)
                                <span class="badge badge-warning mr-0 ml-0" style="font-size: 7px;">Digital</span>
                            @endif

                        </i>
                    </small>
                    <span class="content-right">
                        <a href="#viewModal"
                           class="btn btn-sm btn-outline-success"
                           data-toggle="modal"
                           data-id="{{ $item->id }} "
                           id="view{{ $item->id }}"
                           onclick="view('{{ $item->id }}','{{ $item->title }}','{{ $item->slug }}','{{ $item->featured }}','{{ $item->featured }}','{{$item->image}}')"
                           title="View"><i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('categories.edit',base64_encode($item->id)) }}"
                           class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa fa-edit"></i></a>
                        @if($item->id != 9 && $item->id != 8)
                            <a href="#delete"
                               data-toggle="modal"
                               data-id="{{ $item->id }}"
                               id="delete{{ $item->id }}"
                               title="Delete"
                               class="btn btn-sm btn-outline-danger center-block"
                               onClick="delete_menu({{ $item->id }} )">
                            <i class="fa fa-trash  "></i>
                       </a>
                        @endif
                    </span>
                </div>

                <?php if (isset($item->children)): ?>
                            <?php displayList($item->children); ?>
                        <?php endif; ?>
            </li>
            <?php
            endforeach; ?>
        </ol>
        <?php
        }
        ?>

        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">

                        <h2>Categories</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')  }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Categories</a>
                                </li>
                                @if($id != 0)
                                    <li class="breadcrumb-item active"
                                        aria-current="page">{{ isset($category) ? $category->title : 'Categories' }}</li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ $id != 0 ? route('categories.list') : route('admin-dashboard') }}"
                           class="btn btn-sm btn-outline-primary" title="Go Back">
                            <i class="fa fa-angle-double-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        @if($id == 0)
                            <li class="nav-item"><a class="nav-link show  active" data-toggle="tab"
                                                    href="#Categories">{{ isset($category) ? $category->title : 'Categories' }}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab"
                               href="#addCategory">
                                {{ $id == 0 ? 'Add Category' : 'Update Category '}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        @if($id == 0)
                            <div class="tab-pane show active" id="Categories">
                                <div class="card">
                                    <div class="header card-header">
                                        <h6 class="title mb-0">
                                            All {{ isset($category) ? $category->title : 'Categories' }}</h6>
                                    </div>
                                    <div class="body mt-0">
                                        <div class="dd nestable-with-handle" id="nestable">
                                            <?php isset($categoriesLists) ? displayList($categoriesLists) : '' ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addCategory">
                            <div class="card">
                                <div class="header card-header">
                                    <h6 class="title mb-0">{{ isset($category) ? $category->title : 'Add Categories' }}</h6>
                                </div>
                                <div class="body mt-2">
                                    <form method="post"
                                          action="{{ $id == 0 ? route('categories.create') : route('categories.update') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="categoryId" name="id"
                                               value="{{ $id != 0 ? $id : '' }}"/>
                                        <input type="hidden" id="parentId" name="parent_id"
                                               value="{{ isset($category) ? $category->id : 0 }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                                    class="fa fa-text-width"></i> &nbsp;Title</span>
                                                    </div>
                                                    <input type="text" name="title" class="form-control" required
                                                           value="{{ $id != 0 ? $category->title : '' }}"
                                                           placeholder="eg: Enter Category Title Here..">
                                                </div>
                                            </div>


                                            <div class="d-flex col-md-6">
                                                <div class="input-group mb-3 mr-1">
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
                                                <div class="input-group mb-3">

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <?php $featured = $id != 0 ? $category->featured : 0  ?>
                                                            <input type="checkbox" name="featured"
                                                                   value="1" <?=$featured == 1 ? 'checked' : '' ?>>
                                                        </div>
                                                    </div>
                                                    <input type="button " class="form-control bg-indigo text-muted"
                                                           value="Featured" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                      id="inputGroup-sizing-default"><i
                                                                            class="fa fa-image"></i> &nbsp;Images</span>
                                                            </div>
                                                            <input type="file" name="image"
                                                                   class="bg-primary text-white form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-12">
                                                @if ($id != 0)
                                                    <a href="{{ route('categories.list') }}"
                                                       class="btn btn-outline-danger">CANCEL</a>

                                                    <button type="submit" style="float: right;"
                                                            class="btn btn-outline-success"> UPDATE
                                                    </button>
                                                @else
                                                    <button type="submit" style="float: right;"
                                                            class="btn btn-outline-success"> SAVE
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="clearfix"></div>
                <div class="col-md-12">

                </div>

            </div>

            <div class="modal fade " id="viewModal" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6>View Category
                                <span id="viewDisplay">
                                </span>
                                <span id="viewFeatured">
                                </span>
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body pricing_page text-center pt-4 mb-4">
                            <div class="card ">
                                <div class="card-header">
                                    <h5 id="CategoryTitle"></h5>
                                </div>
                                @if(isset($category->image))
                                    <div class="card-body">
                                        <img id="ViewImage" class="img-fluid"
                                             src="https://via.placeholder.com/750x300?text=Sample + Image + For + Category">
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h6>Content</h6>
                                </div>
                                <div class="card-body border " style="overflow: scroll;">
                                    <p id="viewContents"></p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button style="text-align: right;" type="button" data-dismiss="modal"
                                    class="btn btn-outline-danger">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-white">
                            <p>Are you Sure...!!</p>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                            <a href="" class="btn btn-round btn-primary">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @endsection
        @push('scripts')
            <script>
                $(document).ready(function () {
                    var updateOutput = function (e) {
                        var list = e.length ? e : $(e.target), output = list.data('output');
                        $.ajax({
                            method: "POST",
                            url: "{{ URL::route('categories.order_categories')}}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                list_order: list.nestable('serialize'),
                                parent_id: $('#parentId').val(),
                                table: "categories"
                            },
                            success: function (response) {
                                console.log("success");
                                console.log("response " + response);
                                var obj = jQuery.parseJSON(response);
                                if (obj.status == 'success') {
                                    swal({
                                        title: 'Sorted!',
                                        buttonsStyling: false,
                                        confirmButtonClass: "btn btn-success",
                                        html: '<b>Content</b> Sorted Successfully',
                                        timer: 1000,
                                        type: "success"
                                    }).catch(swal.noop);
                                }
                            }
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            sweetAlert('Failure', 'Something Went Wrong!', 'error');
                        });
                    };

                    $('#nestable').nestable({
                        group: 1,
                        maxDepth: 3,
                    }).on('change', updateOutput);
                });
            </script>
            <script>
                function view(id, title, slug, display, featured, image) {
                    $('#viewId').val(id);
                    $('#CategoryTitle').html(title);
                    content = $("#view" + id).attr('data-content');

                    if (display == 0) {
                        $('#viewDisplay').html('<small class="badge badge-danger">Not Displayed</small>');
                    } else {
                        $('#viewDisplay').html('<small class="badge badge-success">Displayed</small>');
                    }
                    if (featured == 0) {
                        $('#viewFeatured').html('<small class="badge badge-danger">Not Featured</small>');
                    } else {
                        $('#viewFeatured').html('<small class="badge badge-success">Featured</small>');
                    }


                    $('#ViewImage').attr('src', "{{ asset('storage/categories/thumbs/cover_') }}" + image);
                    $('#viewContents').html(content);
                }

                function delete_menu(id) {
                    var conn = './categories/delete/' + id;
                    $('#delete a').attr("href", conn);
                }

            </script>
            <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script>
            <!-- Jquery Nestable -->
        @endpush
    </div>
