@extends('backend.body')
@section('title',  'All-Attributes')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Attributes Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attributes List</li>
                            </ol>
                        </nav>
                    </div>
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                            <a href="{{ route('attributes.create')}}" 
                               class="btn btn-rounded btn-info pull-right">{{__('Add New Attribute')}}</a>
                        </div>
                </div>
                <br>
                <div class="row clearfix">

                    <div class="card">
                        <div class="body">

        <h3 class="card-title badge badge-primary p-3 font-12">{{__('Attributes')}}</h3>
    </div>
  

    
    <div class="table-responsive">
        <table class="table header-border table-hover  spacing5">
            <thead>
            <tr class="text-bold">
                
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attributes as $key => $attribute)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$attribute->name}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('attributes.edit', encrypt($attribute->id))}}">{{__('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('attributes.destroy', $attribute->id)}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
