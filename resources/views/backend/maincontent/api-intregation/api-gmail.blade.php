@extends('backend.body')
@section('title','Settings')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Site Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="">Api</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gmail Credentials</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin-dashboard')}}" class="btn btn-sm btn-round btn-outline-primary" title=""><i
                            class="fa fa-angle-double-left"></i> Go Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                    </div>
                    <div class="body">
                        <form id="advanced-form" data-parsley-validate="" novalidate="" action="{{route('api.gmail.store')}}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                            $gmail = App\Models\ApiIntegration::where('title','gmail')->first();
                                if(isset($gmail))
                                {
                                    $values=json_decode($gmail->values);
                                }
                             @endphp
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL MAILER</span>
                                        </div>
                                        <input type="text" name="value[MAIL_MAILER]" value="{{ isset($values->MAIL_MAILER) ? $values->MAIL_MAILER : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL HOST</span>
                                        </div>
                                        <input type="text" name="value[MAIL_HOST]" value="{{ isset($values->MAIL_HOST) ? $values->MAIL_HOST : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL PORT</span>
                                        </div>
                                        <input type="text" name="value[MAIL_PORT]" value="{{ isset($values->MAIL_PORT) ? $values->MAIL_PORT : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL USERNAME</span>
                                        </div>
                                        <input type="text" name="value[MAIL_USERNAME]" value="{{ isset($values->MAIL_USERNAME) ? $values->MAIL_USERNAME : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL PASSWORD</span>
                                        </div>
                                        <input type="text" name="value[MAIL_PASSWORD]" value="{{ isset($values->MAIL_PASSWORD) ? $values->MAIL_PASSWORD : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;MAIL ENCRYPTION</span>
                                        </div>
                                        <input type="text" name="value[MAIL_ENCRYPTION]" value="{{ isset($values->MAIL_ENCRYPTION) ? $values->MAIL_ENCRYPTION : null }}"
                                            class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="col-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                            value="API Status" disabled>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" name="status"
                                                        value="1" checked></div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                    class="fa fa-info fa-lg"></i> &nbsp;Mode</span>
                                        </div>
                                        <select name="mode" id="" class="form-control">
                                            <option value="development">Development</option>
                                            <option value="live">Live</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-danger">Cancel</button>
                            <button style="float: right" type="submit" class="btn btn-outline-success">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
