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
                                <li class="breadcrumb-item active">Categories List</li>
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
                            <h3 class="badge badge-primary pull-left pad-no">Categories</h3>
                            <div class="pull-right clearfix">
                                <form class="" id="sort_categories" action="" method="GET">
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search"
                                                   name="search"
                                                   @isset($sort_search) value="{{ $sort_search }}"
                                                   @endisset placeholder="Type & Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Banner')}}</th>
                                        <th>{{__('Icon')}}</th>
                                        <th>{{__('Featured')}}</th>
                                        <th>{{__('Commission')}}</th>
                                        <th width="10%">{{__('Options')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                                            <td>{{__($category->name)}}</td>
                                            <td><img loading="lazy" class="img-md"
                                                     src="{{ asset($category->banner) }}"
                                                     alt="{{__('banner')}}"></td>
                                            <td><img loading="lazy" class="img-xs"
                                                     src="{{ asset($category->icon) }}"
                                                     alt="{{__('icon')}}">
                                            </td>
                                            <td><label class="switch">
                                                    <input onchange="update_featured(this)"
                                                           value="{{ $category->id }}"
                                                           type="checkbox" <?php if ($category->featured == 1) echo "checked";?> >
                                                    <span class="slider round"></span></label></td>
                                            <td>{{ $category->commision_rate }} %</td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                            data-toggle="dropdown" type="button">
                                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="{{route('categories.edit', encrypt($category->id))}}">{{__('Edit')}}</a>
                                                        </li>
                                                        <li>
                                                            <a onclick="confirm_modal('{{route('categories.destroy', $category->id)}}');">{{__('Delete')}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="pull-right">
                                        {{ $categories->appends(request()->input())->links() }}
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

@push('scripts')
    <script type="text/javascript">
        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Featured categories updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
