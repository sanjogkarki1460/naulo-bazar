@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Home Settings</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Home Settings</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="container">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab"
                                       href="#Home-withicon"><i class="fa fa-home"></i> Home Categories</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-withicon"><i
                                                class="fa fa-wrench"></i> Top 10</a></li>
                                <li class="nav-item">
                                    <a class="nav-link show " data-toggle="tab"
                                       href="#Image-withicon">
                                       <i class="fa fa-file-image-o"></i> Home Sliders </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show " data-toggle="tab"
                                       href="#Img-banner"><i class="fa fa-file-image-o">
                                           </i> Home Banner</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show " data-toggle="tab"
                                       href="#Img-banner2"><i class="fa fa-file-image-o"></i> Home Banner2</a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="Home-withicon">
                                    <h4 class="text-left badge badge-primary p-3 font-12 ">Home Categories</h4>
                                    <div class="text-right hidden-xs">
                                        <a onclick="add_home_category()" href=" javascript:void(0);" class="btn btn-sm
                                        btn-primary" title="">Add
                                            New
                                            Home Category</a>
                                    </div>
                                    <hr class="bg-info">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show <select name="DataTables_Table_0_length"
                                                                            aria-controls="DataTables_Table_0"
                                                                            class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> entries</label></div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search" class="form-control"
                                                                             placeholder=""
                                                                             aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table header-border table-hover  spacing5">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('Category')}}</th>
                                                            <th>{{ __('Status') }}</th>
                                                            <th width="10%">{{__('Options')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(\App\HomeCategory::all() as $key => $home_category)
                                                        
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$home_category->category->name}}</td>
                                                                    <td><label class="switch">
                                                                            <input onchange="update_home_category_status(this)"
                                                                                   value="{{ $home_category->id }}"
                                                                                   type="checkbox" <?php if ($home_category->status == 1) echo "checked";?> >
                                                                            <span class="slider round"></span></label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                                                    data-toggle="dropdown"
                                                                                    type="button">
                                                                                {{__('Actions')}} <i
                                                                                        class="dropdown-caret"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                                <li>
                                                                                    <a onclick="edit_home_category({{ $home_category->id }})">{{__('Edit')}}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a onclick="confirm_modal('{{route('home_categories.destroy', $home_category->id)}}');">{{__('Delete')}}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Profile-withicon">
                                    <div class="text-right">
                                        <h4 class="badge badge-primary p-3 font-12 ">Top 10 Brands &
                                            Categories</h4>
                                    </div>
                                    <form class="form-horizontal" action="{{ route('top_10_settings.store') }}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-3"
                                                       for="url">{{__('Top Categories (Max 10)')}}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control demo-select2-max-10"
                                                            name="top_categories[]" multiple required>
                                                        @foreach (\App\Category::all() as $key => $category)
                                                            <option value="{{ $category->id }}"
                                                                    @if($category->top == 1) selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3" for="url">{{__('Top Brands (Max 10)')}}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control demo-select2-max-10" name="top_brands[]"
                                                            multiple required>
                                                        @foreach (\App\Brand::all() as $key => $brand)
                                                            <option value="{{ $brand->id }}"
                                                                    @if($brand->top == 1) selected @endif>{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <button class="btn btn-outline-success"
                                                    type="submit">{{__('Save')}}</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane" id="Image-withicon">
                                    <h4 class="text-left badge badge-primary p-3 font-12 ">Sliders</h4>
                                    <div class="text-right hidden-xs">
                                        <a onclick="add_slider()" href=" javascript:void(0);" class="btn btn-sm
                                        btn-primary" title="">Add
                                            New
                                            Slider</a>
                                    </div>
                                    <hr class="bg-info">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show <select name="DataTables_Table_0_length"
                                                                            aria-controls="DataTables_Table_0"
                                                                            class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> entries</label></div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search" class="form-control"
                                                                             placeholder=""
                                                                             aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table header-border table-hover  spacing5">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('Photo')}}</th>
                                                            <th width="50%">{{__('Link')}}</th>
                                                            <th>{{__('Published')}}</th>
                                                            <th width="10%">{{__('Options')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(\App\Slider::get() as $key => $slider)
															
                                                           
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td><img loading="lazy" class="img-md"
                                                                             src="{{ asset($slider->photo)}}"
                                                                             alt="Slider Image"></td>
                                                                    <td>{{$slider->link}}</td>
                                                                    <td><label class="switch">
                                                                            <input onchange="update_slider_published(this)"
                                                                                   value="{{ $slider->id }}"
                                                                                   type="checkbox" <?php if ($slider->published == 1) echo "checked";?> >
                                                                            <span class="slider round"></span></label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                                                    data-toggle="dropdown"
                                                                                    type="button">
                                                                                {{__('Actions')}} <i
                                                                                        class="dropdown-caret"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                                <li>
                                                                                    <a onclick="confirm_modal('{{route('sliders.destroy', $slider->id)}}');">{{__('Delete')}}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="Img-banner">
                                    <h4 class="text-left badge badge-primary p-3 font-12 ">Home Banner</h4>
                                    <div class="text-right hidden-xs">
                                        <a onclick="add_banner_1()" href=" javascript:void(0);" class="btn btn-sm
                                        btn-primary" title="">{{__('Add New Banner')}}</a>
                                    </div>
                                    <hr class="bg-info">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show <select name="DataTables_Table_0_length"
                                                                            aria-controls="DataTables_Table_0"
                                                                            class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> entries</label></div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search" class="form-control"
                                                                             placeholder=""
                                                                             aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table header-border table-hover  spacing5">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{__('Photo')}}</th>
                                                                <th>{{__('Position')}}</th>
                                                                <th>{{__('Published')}}</th>
                                                                <th width="10%">{{__('Options')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(\App\Banner::where('position', 1)->get() as $key => $banner)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                                                <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                                                <td><label class="switch">
                                                                    <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                                                    <span class="slider round"></span></label></td>
                                                                <td>
                                                                    <div class="btn-group dropdown">
                                                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                                            <li><a onclick="edit_home_banner_1({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                                            <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="Img-banner2">
                                    <h4 class="text-left badge badge-primary p-3 font-12 ">Home Banner 2</h4>
                                    <div class="text-right hidden-xs">
                                        <a onclick="add_banner_2()" href=" javascript:void(0);" class="btn btn-sm
                                        btn-primary" title="">{{__('Add New Banner')}}</a>
                                    </div>
                                    <hr class="bg-info">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                                        <label>Show <select name="DataTables_Table_0_length"
                                                                            aria-controls="DataTables_Table_0"
                                                                            class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> entries</label></div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search" class="form-control"
                                                                             placeholder=""
                                                                             aria-controls="DataTables_Table_0"></label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table header-border table-hover  spacing5">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{__('Photo')}}</th>
                                                                <th>{{__('Position')}}</th>
                                                                <th>{{__('Published')}}</th>
                                                                <th width="10%">{{__('Options')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(\App\Banner::where('position', 2)->get() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img loading="lazy"  class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td>{{ __('Banner Position ') }}{{ $banner->position }}</td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_banner_2({{ $banner->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

           

                
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <small>
            </small>
            
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal" action="{{ route('home_categories.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Home Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <select class="form-control demo-select2-placeholder" name="category_id" id="category_id"
                                required>
                            @foreach(\App\Category::all() as $category)
                                @if (\App\HomeCategory::where('category_id', $category->id)->first() == null)
                                    <option value="{{$category->id}}">{{__($category->name)}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-round btn-success">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        function updateSettings(el, type) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }
            $.post('{{ route('business_settings.update.activation') }}', {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Settings updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function add_slider() {
            $.get('{{ route('sliders.create')}}', {}, function (data) {
                $('#Image-withicon').html(data);
            });
        }

        function add_banner_1() {
            $.get('{{ route('home_banners.create', 1)}}', {}, function (data) {
                $('#Img-banner').html(data);
            });
        }

        function add_banner_2() {
            $.get('{{ route('home_banners.create', 2)}}', {}, function (data) {
                $('#Img-banner2').html(data);
            });
        }

        function edit_home_banner_1(id) {
            var url = '{{ route("home_banners.edit", "home_banner_id") }}';
            url = url.replace('home_banner_id', id);
            $.get(url, {}, function (data) {
                $('#demo-lft-tab-2').html(data);
                $('.demo-select2-placeholder').select2();
            });
        }

        function edit_home_banner_2(id) {
            var url = '{{ route("home_banners.edit", "home_banner_id") }}';
            url = url.replace('home_banner_id', id);
            $.get(url, {}, function (data) {
                $('#Img-banner2').html(data);
                $('.demo-select2-placeholder').select2();
            });
        }

        function add_home_category() {
            $.get('{{ route('home_categories.create')}}', {}, function (data) {
				
                $('#Home-withicon').html(data);
             });
        }

        function edit_home_category(id) {
            var url = '{{ route("home_categories.edit", "home_category_id") }}';
            url = url.replace('home_category_id', id);
            $.get(url, {}, function (data) {
                 $('#Home-withicon').html(data);
                $('.demo-select2-placeholder').select2();
            });
        }

        function update_home_category_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('home_categories.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Home Page Category status updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_banner_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('home_banners.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Banner status updated successfully');
                } else {
                    showAlert('danger', 'Maximum 4 banners to be published');
                }
            });
        }

        function update_slider_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            var url = '{{ route('sliders.update', 'slider_id') }}';
            url = url.replace('slider_id', el.value);

            $.post(url, {_token: '{{ csrf_token() }}', status: status, _method: 'PATCH'}, function (data) {
                if (data == 1) {
                    showAlert('success', 'Published sliders updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
