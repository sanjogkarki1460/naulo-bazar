@extends('backend.body')
@section('title', isset($page) ? $page->title : 'Pages')
@section('body')

    <script>
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target), output = list.data('output');

                $.ajax({
                    method: "POST",
                    url: "{{ URL::route('pages.order_pages')}}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        list_order: list.nestable('serialize'),
                        parent_id: $('#parentId').val(),
                        table: "pages"
                    },
                    success: function (response) {
                        console.log("success");
                        console.log("response " + response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == 'success') {
                            swal({
                                title: 'Success!',
                                buttonsStyling: false,
                                confirmButtonClass: "btn btn-success",
                                html: '<b>Content</b> Sorted Successfully',
                                timer: 1000,
                                type: "success"
                            }).catch(swal.noop);
                        }
                        ;

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
                <b>{{ $item->title }}</b>&nbsp;|&nbsp; <small> <i>{{ $item->slug }}</i></small>
                <span class="content-right">
                    <a href="#viewPage"
                       class="btn btn-sm btn-outline-success"
                       data-toggle="modal"
                       data-id="{{ $item->id }} "
                       data-subtitles='{{ addslashes($item->subtitles) }}'
                       data-content='{{ addslashes($item->content) }}'
                       id="view{{ $item->id }}"
                       onclick="view('{{ $item->id }}','{{ addslashes($item->title) }}','{{ $item->slug }}','{{ $item->display }}','{{ $item->image }}')"
                       title="View"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ url('/pages/edit/'.base64_encode($item->id)) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="#delete"
                       data-toggle="modal"
                       data-id="{{ $item->id }}"
                       id="delete{{ $item->id }}"
                       class="btn btn-sm btn-outline-danger center-block"
                       onClick="delete_menu({{ $item->id }} )"><i class="fa fa-trash  "></i>
                   </a>
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
 <div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">

                    <h2>{{ isset($page) ? $page->title : 'Pages' }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard')  }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pages.list') }}">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pages List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ $id != 0 ? route('pages.list') : route('admin-dashboard') }}" class="btn btn-sm btn-outline-primary" title="Go Back">
                        <i class="fa fa-angle-double-left"></i> Go Back
                    </a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    @if($id == 0)
                    <li class="nav-item"><a class="nav-link show  active" data-toggle="tab" href="#Pages">{{ isset($page) ? $page->title : 'Pages' }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $id != 0 ? 'show active' : '' }}" data-toggle="tab" href="#addPage">
                            {{ $id == 0 ? 'Add Page' : 'Update Page | '.$page->title }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-0">
                    @if($id == 0)
                    <div class="tab-pane show active" id="Pages">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">All {{ isset($page) ? $page->title : 'Pages' }}</h6>
                            </div>
                            <div class="body mt-0">
                                <div class="dd nestable-with-handle" id="nestable">
                                    <?php isset($pages) ? displayList($pages) : '' ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                    <div class="tab-pane {{ $id != 0 ? 'show active' : '' }}" id="addPage">
                        <div class="card">
                            <div class="header card-header">
                                <h6 class="title mb-0">Add {{ isset($page) ? $page->title : 'Pages' }}</h6>
                            </div>
                            <div class="body mt-2">
                                <form method="post" action="{{ $id == 0 ? route('pages.create') : route('pages.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="pageId" name="id" value="{{ $id != 0 ? $id : '' }}"/>
                                    <input type="hidden" id="parentId" name="parent_id" value="{{ isset($page) ? $page->id : 0 }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-text-width"></i> &nbsp;Title</span>
                                                </div>
                                                <input type="text" name="title" class="form-control"  required value="{{ $id != 0 ? $page->title : '' }}" placeholder="eg: Enter Page Title Here..">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-text-width"></i> &nbsp;Sub Title</span>
                                                </div>
                                                <input type="text" name="subtitles" class="form-control" value="{{ $id != 0 ? $page->subtitles : '' }}" placeholder="eg: Enter Page Sub Title Here..">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <?php $display =  $id != 0 ? $page->display : 0  ?>
                                                        <input type="checkbox" name="display" value="1" <?=$display == 1 ? 'checked' : '' ?>>
                                                    </div>
                                                </div>
                                                <input type="button " class="form-control bg-indigo text-muted" value="Display" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-image"></i> &nbsp;Images</span>
                                                </div>
                                                <input type="file" name="image" class="bg-primary text-white form-control">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-file-text-o"></i> &nbsp;Content</span>
                                                </div>
                                             
                                                <textarea class="form-control summernote" name="content">{{ $id != 0 ? $page->content : '' }}</textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @if ($id != 0)
                                            <a href="{{ route('pages.list') }}"
                                            class="btn btn-outline-danger">CANCEL</a>

                                            <button type="submit" style="float: right;" class="btn btn-outline-success"> UPDATE</button>
                                            @else
                                            <button type="submit" style="float: right;" class="btn btn-outline-success"> SAVE</button>
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

        <div class="modal fade " id="viewPage" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>View Page
                            <span id="viewDisplay">
                            </span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body pricing_page text-center pt-4 mb-4">
                        <div class="card ">
                            <div class="card-header">
                                <h5 id="PageTitle"></h5>
                                <small class="text-muted" id="PageSubTitle">Page Subtitle</small>
                            </div>
                            <div class="card-body">
                                <img id="ViewImage" class="img-fluid" width="40%" src="https://via.placeholder.com/750x300?text=Sample + Image + For + Page">
                            </div>
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
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Page</h5>
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
 </div>

@endsection
@push('scripts')
    <script>
        function view(id, title, slug, status, image) {
            var subtitle = $("#view"+id).attr('data-subtitles');
            var content = $("#view"+id).attr('data-content');
            $('#viewId').val(id);
            $('#PageTitle').html(title);
            $('#PageSubTitle').html(subtitle);

            if (status == 0) {
                $('#viewDisplay').html('<small class="badge badge-danger">Not Displayed</small>');
            } else {
                $('#viewDisplay').html('<small class="badge badge-success">Displayed</small>');
            }


            $('#ViewImage').attr('src', "{{ asset('storage/pages/')}}/" + slug + "/thumbs/large_" + image);
            $('#viewContents').html(content);
        }

        function delete_menu(id) {
            var conn = './pages/delete/' + id;
            $('#delete a').attr("href", conn);
        }

    </script>

@endpush