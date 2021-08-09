@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Vendor Commission Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Sellers</li>
                                <li class="breadcrumb-item active">Vendor Commission</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card">
                    <div class="body mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-horizontal"
                                      action="{{ route('business_settings.vendor_commission.update') }}"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type"
                                           value="{{ $business_settings->type }}">
                                    <label class="col-md-6 font-weight-bolder badge badge-primary control-label">{{__('Seller Commission')}}</label>
                                    <div class="input-group-prepend">
                                        <input type="number" min="0" step="0.01"
                                               value="{{ $business_settings->value }}"
                                               placeholder="{{__('Seller Commission')}}" name="value"
                                               class="form-control"> <span class="p-2"><b>%</b></span>

                                    </div>
                                    <div class="panel-footer text-right pt-2">
                                        <button class="btn btn-success" type="submit">{{__('Save')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="heading">
                                    <h3 class="font-weight-bolder badge badge-primary">{{__('Note')}}</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            1.{{ $business_settings->value }}% of seller product price will
                                            be
                                            deducted from seller
                                            earnings.
                                        </li>
                                        <li class="list-group-item">
                                            1. This commission only works when Category Based Commission is
                                            turned off from Business
                                            Settings.
                                        </li>
                                        <li class="list-group-item">
                                            1. Commission doesn't work if seller package system add-on is
                                            activated.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Horizontal Form-->
            </div>
        </div>
    </div>
@endsection
