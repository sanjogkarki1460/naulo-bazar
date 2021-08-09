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
                        <a href="{{ route('subsubcategories.create')}}"
                           class="btn btn-rounded btn-info pull-right">{{__('Add New Sub Subcategory')}}</a>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="card">
                        <div class="body">

                            <h3 class="badge badge-primary pull-left pad-no">Sub Categories</h3>
                            <div class="pull-right clearfix">
                                <form class="" id="sort_subsubcategories" action="" method="GET">
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search"
                                                   name="search"
                                                   @isset($sort_search) value="{{ $sort_search }}"
                                                   @endisset placeholder=" Type name & Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table header-border table-hover  spacing5">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Sub Subcategory')}}</th>
                                        <th>{{__('Subcategory')}}</th>
                                        <th>{{__('Category')}}</th>
                                        {{-- <th>{{__('Attributes')}}</th> --}}
                                        <th width="10%">{{__('Options')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subsubcategories as $key => $subsubcategory)
                                        @if ($subsubcategory->subcategory != null && $subsubcategory->subcategory->category != null)
                                            <tr>
                                                <td>{{ ($key+1) + ($subsubcategories->currentPage() - 1)*$subsubcategories->perPage() }}</td>
                                                <td>{{__($subsubcategory->name)}}</td>
                                                <td>{{$subsubcategory->subcategory->name}}</td>
                                                <td>{{$subsubcategory->subcategory->category->name}}</td>
                                                <td>
                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                                data-toggle="dropdown" type="button">
                                                            {{__('Actions')}} <i class="dropdown-caret"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="{{route('subsubcategories.edit', encrypt($subsubcategory->id))}}">{{__('Edit')}}</a>
                                                            </li>
                                                            <li>
                                                                <a onclick="confirm_modal('{{route('subsubcategories.destroy', $subsubcategory->id)}}');">{{__('Delete')}}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="pull-right">
                                        {{ $subsubcategories->appends(request()->input())->links() }}
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
