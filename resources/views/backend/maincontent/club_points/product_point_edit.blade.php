@extends('backend.body')

@section('body')

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-8 col-sm-12">
                    <h1>Reward Points</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('club_points.index')}}">Reward Points</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Point</li>
                        </ol>
                    </nav>
                </div>            
                
            </div>
        </div>
        
        <div class="row  clearfix ">
            <div class="card">
            <div class="body">
                <div class="card-heading text-center">
                    <h3 class="panel-title  badge badge-primary p-3 font-12">{{__('Set Point for Product')}}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('product_point.update', $product->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="control-label"><strong>{{__('Set Point')}}</strong></label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" min="0" step="0.01" class="form-control" name="point" value="{{ $product->earn_point }}" placeholder="100" required>
                            </div>
                        </div>
                        <div class="form-group m-2">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
