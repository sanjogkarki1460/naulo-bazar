@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>System Configuration</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Configuration</a></li>
                                <li class="breadcrumb-item active" aria-current="page">System</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="card">
                    <div class="body">
                        <div class="heading text-center mb-4">
                            <h4 class="text-center badge badge-danger font-14 py-2">{{__('Maintenance Mode')}}</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="">
                                    <h4 class="text-danger badge p-3 font-13 badge-danger">{{__('Maintenance Mode Activation')}}</h4>
                                </div>
                                <div class="py-1 pl-5">
                                    <label class="switch">
                                        <input type="checkbox"
                                               onchange="updateSettings(this, 'maintenance_mode')" <?php if (\App\BusinessSetting::where('type', 'maintenance_mode')->first()->value == 1) echo "checked";?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{--                    <div class="row">--}}
                    {{--                        <h3 class="text-center">{{__('Classified Product Activate')}}</h3>--}}
                    {{--                        <div class="col-md-4">--}}
                    {{--                            <div class="panel">--}}
                    {{--                                <div class="panel-heading">--}}
                    {{--                                    <h3 class="panel-title text-center">{{__('Classified Product')}}</h3>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="panel-body text-center">--}}
                    {{--                                    <label class="switch">--}}
                    {{--                                        <input type="checkbox"--}}
                    {{--                                               onchange="updateSettings(this, 'classified_product')" <?php if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1) echo "checked";?>>--}}
                    {{--                                        <span class="slider round"></span>--}}
                    {{--                                    </label>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <hr class="bg-info">
                    <div class="card">
                        <div class="body">
                            <div class="heading text-center mb-4">
                                <h3 class="badge badge-info p-3 font-14">{{__('Business Related')}}</h3>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="heading text-center">
                                        <h4 class="badge badge-info font-12 p-3">{{__('Vendor System Activation')}}</h4>
                                        <div class="panel-body text-center">
                                            <label class="switch">
                                                <input type="checkbox"
                                                       onchange="updateSettings(this, 'vendor_system_activation')" <?php if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1) echo "checked";?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="heading text-center">
                                        <h3 class="badge badge-info p-3 font-12 text-center">{{__('Coupon System Activation')}}</h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onchange="updateSettings(this, 'coupon_system')" <?php if (\App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1) echo "checked";?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>


                                {{--                        <div class="row">--}}
                                {{--                            <div class="col-md-4">--}}
                                {{--                                <div class="panel">--}}
                                {{--                                    <div class="panel-heading">--}}
                                {{--                                        <h3 class="panel-title text-center">{{__('Pickup Point Activation')}}</h3>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="panel-body text-center">--}}
                                {{--                                        <label class="switch">--}}
                                {{--                                            <input type="checkbox"--}}
                                {{--                                                   onchange="updateSettings(this, 'pickup_point')" <?php if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1) echo "checked";?>>--}}
                                {{--                                            <span class="slider round"></span>--}}
                                {{--                                        </label>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                           --}}
                                {{--                            <div class="col-md-4">--}}
                                {{--                                <div class="panel">--}}
                                {{--                                    <div class="panel-heading">--}}
                                {{--                                        <h3 class="panel-title text-center">{{__('Conversation Activation')}}</h3>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="panel-body text-center">--}}
                                {{--                                        <label class="switch">--}}
                                {{--                                            <input type="checkbox"--}}
                                {{--                                                   onchange="updateSettings(this, 'conversation_system')" <?php if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1) echo "checked";?>>--}}
                                {{--                                            <span class="slider round"></span>--}}
                                {{--                                        </label>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}

                                <div class="col-md-4">
                                    <div class="heading">
                                        <h4 class="badge badge-info p-3 text-center font-12">{{__('Guest Checkout Activation')}}</h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onchange="updateSettings(this, 'guest_checkout_active')" <?php if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1) echo "checked";?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <div class="heading text-center">
                                        <h4 class="badge badge-info p-3 font-12 ">{{__('Category-based Commission')}}</h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onchange="updateSettings(this, 'category_wise_commission')" <?php if (\App\BusinessSetting::where('type', 'category_wise_commission')->first()->value == 1) echo "checked";?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <div class="alert"
                                             style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                            Seller commission will be disabled after activating this option and You
                                            need to set commission on each category otherwise Admin will not get
                                            any
                                            commission. <a href="{{ route('categories.index') }}">Set Commission
                                                Now</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4  mt-3">
                                    <div class="panel">
                                        <div class="panel-heading text-center">
                                            <h4 class="badge badge-info p-3 font-12">{{__('Email Verification')}}</h4>
                                        </div>
                                        <div class="panel-body text-center">
                                            <label class="switch">
                                                <input type="checkbox"
                                                       onchange="updateSettings(this, 'email_verification')" <?php if (\App\BusinessSetting::where('type', 'email_verification')->first()->value == 1) echo "checked";?>>
                                                <span class="slider round"></span>
                                            </label>
                                            <div class="alert"
                                                 style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                                You need to configure SMTP correctly to enable this feature. <a
                                                        href="{{ route('smtp_settings.index') }}">Configure Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-info">
                        <div class="card">
                            <div class="body">
                                <div class="heading text-center mb-4">
                                    <h3 class="text-center badge badge-default p-3 font-14">{{__('Payment Related')}}</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="heading text-center bord-btm">
                                            <h4 class="badge badge-default p-3 font-12">{{__('Paypal Payment Activation')}}</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="clearfix">
                                                <img loading="lazy" class="pull-left"
                                                     src="{{ asset('frontend/images/icons/cards/paypal.png') }}"
                                                     height="30">
                                                <label class="switch pull-right">
                                                    <input type="checkbox"
                                                           onchange="updateSettings(this, 'paypal_payment')" <?php if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1) echo "checked";?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="alert text-center"
                                                 style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                                You need to configure Paypal correctly to enable this feature. <a
                                                        href="{{ route('payment_method.index') }}">Configure Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--                            <div class="col-md-4">--}}
                        {{--                                <div class="panel">--}}
                        {{--                                    <div class="panel-heading">--}}
                        {{--                                        <h3 class="panel-title text-center">{{__('Stripe Payment Activation')}}</h3>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="panel-body text-center">--}}
                        {{--                                        <div class="clearfix">--}}
                        {{--                                            <img loading="lazy" class="pull-left"--}}
                        {{--                                                 src="{{ asset('frontend/images/icons/cards/stripe.png') }}"--}}
                        {{--                                                 height="30">--}}
                        {{--                                            <label class="switch pull-right">--}}
                        {{--                                                <input type="checkbox"--}}
                        {{--                                                       onchange="updateSettings(this, 'stripe_payment')" <?php if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1) echo "checked";?>>--}}
                        {{--                                                <span class="slider round"></span>--}}
                        {{--                                            </label>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="alert"--}}
                        {{--                                             style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">--}}
                        {{--                                            You need to configure Stripe correctly to enable this feature. <a--}}
                        {{--                                                    href="{{ route('payment_method.index') }}">Configure Now</a>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                    </div>
                    <hr class="bg-info">
                    <div class="card">
                        <div class="body">
                            <div class="heading text-center mb-4">
                                <h3 class="text-center badge p-3 font-14 badge-header">{{__('Social Media Login')}}</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading text-center ">
                                        <h4 class="badge badge-default p-3 font-12 text-center bg-blue">{{__('Facebook login')}}</h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onchange="updateSettings(this, 'facebook_login')" <?php if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1) echo "checked";?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <div class="alert"
                                             style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                            You need to configure Facebook Client correctly to enable this
                                            feature.
                                            <a href="{{ route('social_login.index') }}">Configure Now</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="heading text-center">
                                        <h4 class="badge badge-default p-3 font-12 text-center bg-red">{{__('Google login')}}</h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onchange="updateSettings(this, 'google_login')" <?php if (\App\BusinessSetting::where('type', 'google_login')->first()->value == 1) echo "checked";?>>
                                            <span class="slider round"></span>
                                        </label>
                                        <div class="alert"
                                             style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                            You need to configure Google Client correctly to enable this
                                            feature. <a
                                                    href="{{ route('social_login.index') }}">Configure Now</a>
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

        @push('scripts')
            <script type="text/javascript">
                function updateSettings(el, type) {
                    if ($(el).is(':checked')) {
                        var value = 1;
                    } else {
                        var value = 0;
                    }
                    $.post('{{ route('business_settings.update.activation') }}', {
                        _token: '{{ csrf_token() }}',
                        type: type,
                        value: value
                    }, function (data) {
                        if (data == '1') {
                            showAlert('success', 'Settings updated successfully');
                        } else {
                            showAlert('danger', 'Something went wrong');
                        }
                    });
                }
            </script>
    @endpush
