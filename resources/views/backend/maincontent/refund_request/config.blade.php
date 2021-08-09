@extends('backend.body')

@section('body')


@php
    $refund_time_config = \App\BusinessSetting::where('type', 'refund_request_time')->first();
@endphp
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h3 class="panel-title pull-left pad-no badge badge-primary p-3 font-12">{{__('Set Refund Time')}}</h3>
                </div>
            </div>

           
            <div class="row clearfix">

                <div class="card">
                    <div class="body">

                        <form class="form-horizontal" action="{{ route('refund_request_time_config') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="hidden" name="type" value="refund_request_time">
                                    <label class="col-lg-5 control-label">{{__('Set Time for sending Refund Request')}}</label>
                                    <div class="col-lg-3">
                                        <input type="number" min="0" step="1" @if ($refund_time_config != null) value="{{ $refund_time_config->value }}" @endif placeholder="" name="value" class="form-control">
                                    </div>
                                    <div class="col-lg-1">
                                        <option class="form-control">days</option>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                            </div>
                        </form>


<div class="row">
    <div class="col-lg-6">
        <div class="panel">
           
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center badge badge-primary p-3 font-12">{{__('Set Refund Sticker')}}</h3>
            </div>
            <form class="form-horizontal" action="{{ route('refund_sticker_config') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="refund_sticker">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="logo">{{__('Sticker')}}</label>
                            <div class="col-lg-5">
                                <input type="file" id="logo" name="logo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
