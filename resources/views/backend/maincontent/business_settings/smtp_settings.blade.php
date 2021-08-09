@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>SMTP Setting</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Configuration</a></li>
                                <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="body">
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}"
                          method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="heading text-center">
                                    <h4 class=" badge badge-primary font-14 p-2 font-weight-bold text-center">{{__('SMTP Settings')}}</h4>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                        class="fa fa-text-width"></i> &nbsp;Mail Driver</span>
                                            <select class="demo-select2 form-control col-md-12" name="MAIL_DRIVER"
                                                    onchange="checkMailDriver()">
                                                <option value="sendmail"
                                                        @if (env('MAIL_DRIVER') == "sendmail") selected @endif>
                                                    Sendmail
                                                </option>
                                                <option value="smtp"
                                                        @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP
                                                </option>
                                                <option value="mailgun"
                                                        @if (env('MAIL_DRIVER') == "mailgun") selected @endif>
                                                    Mailgun
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div id="smtp">
                                    <div class="col-md-6 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_HOST">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i> &nbsp;Mail Host</span>
                                                <input type="text" class="form-control col-md-12" name="MAIL_HOST"
                                                       value="{{  env('MAIL_HOST') }}" placeholder="MAIL HOST">

                                            </div>
                                        </div>
                                    </div>


                                    <br>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_PORT">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i>{{__('MAIL PORT')}}</span>
                                                <input type="text" class="form-control" name="MAIL_PORT"
                                                       value="{{  env('MAIL_PORT') }}" placeholder="MAIL PORT">
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i>{{__('MAIL USERNAME')}}</span>
                                                <input type="text" class="form-control col-md-12" name="MAIL_USERNAME"
                                                       value="{{  env('MAIL_USERNAME') }}"
                                                       placeholder="MAIL USERNAME">
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i>{{__('MAIL PASSWORD')}}</span>
                                                <input type="text" class="form-control col-md-12" name="MAIL_PASSWORD"
                                                       value="{{  env('MAIL_PASSWORD') }}"
                                                       placeholder="MAIL PASSWORD">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">{{__('MAIL ENCRYPTION')}}</span>
                                                <input type="text" class="form-control col-md-12" name="MAIL_ENCRYPTION"
                                                       value="{{  env('MAIL_ENCRYPTION') }}"
                                                       placeholder="MAIL ENCRYPTION">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">{{__('MAIL FROM ADDRESS')}}</span>
                                                <input type="text" class="form-control col-md-12"
                                                       name="MAIL_FROM_ADDRESS"
                                                       value="{{  env('MAIL_FROM_ADDRESS') }}"
                                                       placeholder="MAIL FROM ADDRESS">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]">
                                                <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">{{__('MAIL FROM NAME')}}</span>
                                                <input type="text" class="form-control col-md-12" name="MAIL_FROM_NAME"
                                                       value="{{  env('MAIL_FROM_NAME') }}"
                                                       placeholder="MAIL FROM NAME">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="mailgun">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default"><i class="fa fa-text-width"></i>{{__('MAILGUN DOMAIN')}}</span>
                                                <input type="text" class="form-control col-md-12" name="MAILGUN_DOMAIN"
                                                       value="{{  env('MAILGUN_DOMAIN') }}"
                                                       placeholder="MAILGUN DOMAIN">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default"><i
                                                            class="fa fa-text-width"></i>{{__('MAILGUN SECRET')}}</span>
                                                <input type="text" class="form-control col-md-12"
                                                       name="MAILGUN_SECRET"
                                                       value="{{  env('MAILGUN_SECRET') }}"
                                                       placeholder="MAILGUN SECRET">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-outline-success"
                                            type="submit">{{__('Save')}}</button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="heading text-bold">
                                    <h3 class="badge badge-warning font-weight-bold p-3">{{__('Instruction')}}</h3>
                                    <p class="text-danger font-weight-bold">{{ __('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.') }}</p>
                                </div>
                                <hr class="bg-info">
                                <p>{{ __('For Non-SSL') }}</p>
                                <ul class="list-group">
                                    <li class="list-group-item text-dark">Select 'sendmail' for Mail Driver if
                                        you face any issue
                                        after configuring 'smtp' as Mail Driver
                                    </li>
                                    <li class="list-group-item text-dark">Set Mail Host according to your server
                                        Mail Client Manual
                                        Settings
                                    </li>
                                    <li class="list-group-item text-dark">Set Mail port as '587'</li>
                                    <li class="list-group-item text-dark">Set Mail Encryption as 'ssl' if you
                                        face issue with
                                        'tls'
                                    </li>
                                </ul>
                                <hr class="bg-info">
                                <h3 class="badge badge-warning font-weight-bold font-12 p-3">{{ __('For SSL') }}</h3>
                                <ul class="list-group mar-no">
                                    <li class="list-group-item text-dark">Select 'sendmail' for Mail Driver if
                                        you face any issue
                                        after configuring 'smtp' as Mail Driver
                                    </li>
                                    <li class="list-group-item text-dark">Set Mail Host according to your server
                                        Mail Client Manual
                                        Settings
                                    </li>
                                    <li class="list-group-item text-dark">Set Mail port as '465'</li>
                                    <li class="list-group-item text-dark">Set Mail Encryption as 'ssl'</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            checkMailDriver();
        });

        function checkMailDriver() {
            if ($('select[name=MAIL_DRIVER]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endpush
