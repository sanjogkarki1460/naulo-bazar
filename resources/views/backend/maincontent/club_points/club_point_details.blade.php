@extends('backend.body')
@section('body')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Reward Points</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('club_points.index')}}">Reward Points</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                            </ol>
                        </nav>
                    </div>            
                    
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="20%">{{__('Product Name')}}</th>
                                <th>{{__('Points')}}</th>
                                <th>{{__('Earned At')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($club_point_details as $key => $club_point)
                                <tr>
                                    <td>{{ ($key+1) + ($club_point_details->currentPage() - 1)*$club_point_details->perPage() }}</td>
                                    @if ($club_point->product != null)
                                        <td>{{ $club_point->product->name }}</td>
                                    @endif
                                    <td>{{ $club_point->point }}</td>
                                    <td>{{ $club_point->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="pull-right">
                            {{ $club_point_details->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
