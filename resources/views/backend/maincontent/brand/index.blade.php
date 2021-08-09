@extends('backend.body')

@section('body')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Brand Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Brand</li>
                                <li class="breadcrumb-item active">All Brands</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ route('brands.create')}}"
                           class="btn btn-rounded btn-info pull-right">{{__('Add New Brand')}}</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-striped res-table mar-no" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Logo')}}</th>
                            <th width="10%">{{__('Options')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $key => $brand)
                            <tr>
                                <td>{{ ($key+1) + ($brands->currentPage() - 1)*$brands->perPage() }}</td>
                                <td>{{$brand->name}}</td>
                                <td><img loading="lazy" class="img-md"
                                         src="{{ asset($brand->logo) }}" alt="Logo"></td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                data-toggle="dropdown" type="button">
                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{route('brands.edit', encrypt($brand->id))}}">{{__('Edit')}}</a>
                                            </li>
                                            <li>
                                                <a onclick="confirm_modal('{{route('brands.destroy', $brand->id)}}');">{{__('Delete')}}</a>
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
                            {{ $brands->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function sort_brands(el) {
            $('#sort_brands').submit();
        }
    </script>
@endsection
