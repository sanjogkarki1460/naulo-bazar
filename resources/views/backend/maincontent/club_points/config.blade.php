@extends('backend.body')
@section('body')
@php
    $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
@endphp
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
                        <li class="breadcrumb-item active" aria-current="page">Configuration</li>
                        </ol>
                    </nav>
                </div>            
                
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="card">
            <div class="col-lg-12 body">
              
        
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">                <div class="card-heading">
                    <h3 class="panel-title text-center"><span class="badge badge-primary p-3 font-12">Convert Points</span></h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="club_point_convert_rate">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label"><strong>{{__('Set Point For ')}} {{ single_price(1) }}</strong></label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="value" @if ($club_point_convert_rate != null) value="{{ $club_point_convert_rate->value }}" @endif placeholder="100" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label class="control-label"><strong>{{__('Points')}}</strong></label>
                            </div>
                        </div>
                        <div class="form-group m-2">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                    </form>
                    <p class="h5 text-center text-danger">Note: You need to activate wallet option first before using club point</p>
                </div>
            </div>
        </div>
    </div>

@endsection
