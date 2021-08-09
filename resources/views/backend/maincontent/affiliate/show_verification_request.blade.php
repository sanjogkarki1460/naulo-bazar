@extends('backend.body')

@section('body')

    <!-- Basic Data Tables -->
    <!--===================================================-->

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Affiliation Verification</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Affiliate System</li>
                                <li class="breadcrumb-item active">Verification</li>
                            </ol>
                        </nav>
                    </div>

                </div>

                <div class="row clearfix">
                    <div class="card">
                        <div class="body">
                            <div class="header">
                                <span class="badge badge-primary py-2 text-bold">{{__('Affiliate User Verification')}}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel-heading p-2 mb-4">
                                        <h3 class="text-lg">{{__('User Info')}}</h3>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 font-weight-bold control-label"
                                               for="name">{{__('Name')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $affiliate_user->user->name  }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Email')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $affiliate_user->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label"
                                               for="name">{{__('Address')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $affiliate_user->user->address ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="name">{{__('Phone')}}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $affiliate_user->user->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel-heading p-2 mb-4">
                                        <h3 class="text-lg">{{__('Verification Info')}}</h3>
                                    </div>
                                    <table class="table table-striped table-bordered" cellspacing="0"
                                           width="100%">
                                        <tbody>
                                        @foreach (json_decode($affiliate_user->informations) as $key => $info)
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
                                    <div class="text-center">
                                        <a href="{{ route('affiliate_user.reject', $affiliate_user->id) }}"
                                           class="btn btn-default d-innline-block">{{__('Reject')}}</a></li>
                                        <a href="{{ route('affiliate_user.approve', $affiliate_user->id) }}"
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
