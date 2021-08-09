@extends('backend.body')

@section('body')

    <!-- Basic Data Tables -->
    <!--===================================================-->

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Seller Verification Information</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Sellers</li>
                                <li class="breadcrumb-item active">Verification</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="{{ url()->previous()}}"
                           class="btn btn-rounded btn-info pull-right"><i class="fa fa-backward">Go Back</i></a>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="card">
                        <div class="body">
                            <h3 class="badge badge-primary py-2">{{__('Seller Verification')}}</h3>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="heading">
                                        <h5 class="text-sm">{{__('User Info')}}</h5>
                                        <hr class="bg-info">
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Email')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Address')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->address }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Phone')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="heading pt-3">
                                        <h5 class="text-sm">{{__('Shop Info')}}</h5>
                                        <hr class="bg-info">

                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Shop Name')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->shop->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Address')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $seller->user->shop->address }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="heading">
                                        <h5 class="text-sm">{{__('Verification Info')}}</h5>
                                        <hr class="bg-info">
                                    </div>
                                    <table class="table-striped">
                                        <tbody>
                                        @foreach (json_decode($seller->verification_info) as $key => $info)
                                            <tr>
                                                <th>{{ $info->label }}</th>
                                                @if ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio')
                                                    <td>{{ $info->value }}</td>
                                                @elseif ($info->type == 'multi_select')
                                                    <td>
                                                        {{ implode(json_decode($info->value), ', ') }}
                                                    </td>
                                                @elseif ($info->type == 'file')
                                                    <td>
                                                        <a href="{{ asset($info->value) }}" target="_blank"
                                                           class="btn-info">{{__('Click here')}}</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('sellers.reject', $seller->id) }}"
                                           class="btn btn-default d-innline-block">{{__('Reject')}}</a></li>
                                        <a href="{{ route('sellers.approve', $seller->id) }}"
                                           class="btn btn-primary d-innline-block">{{__('Accept')}}</a>
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
