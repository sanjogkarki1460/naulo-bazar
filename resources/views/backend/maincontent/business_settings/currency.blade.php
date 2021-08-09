@extends('backend.body')

@section('body')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Currency Section</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Configuration</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Currency Setting</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-sm-12 text-right">
                        <a onclick="currency_modal()"
                           class="btn btn-rounded btn-info">{{__('Add New Currency')}}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card col-md-6">

                    <div class="body">
                        <div class="heading text-center mb-2">
                            <h3 class="text-center badge badge-primary p-3 font-12">{{__('System Default Currency')}}</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('business_settings.update') }}"
                              method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                   <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                               class="fa fa-text-width"></i>{{__('System Default Currency')}}</span>
                                    <select class="form-control col-md-6 demo-select2-placeholder"
                                            name="system_default_currency">
                                        @foreach ($active_currencies as $key => $currency)
                                            <option value="{{ $currency->id }}" <?php if (\App\BusinessSetting::where('type', 'system_default_currency')->first()->value == $currency->id) echo 'selected'?> >{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="types[]" value="system_default_currency">
                            <div class="text-right">
                                <button class="btn btn-outline-success" type="submit">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card col-md-6">
                    <div class="body">
                        <div class="header text-center">
                            <h3 class="badge badge-primary font-12 p-3 text-center mb-2">{{__('Set Currency Formats')}}</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('business_settings.update') }}"
                              method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <input type="hidden" name="types[]" value="symbol_format">
                                        <span class="input-group-text inputGroup-sizing-default">{{__('Symbol Format')}}</span>
                                        <select class="form-control demo-select2-placeholder"
                                                name="symbol_format">
                                            <option value="1"
                                                    @if(\App\BusinessSetting::where('type', 'symbol_format')->first()->value == 1) selected @endif>
                                                [Symbol] [Amount]
                                            </option>
                                            <option value="2"
                                                    @if(\App\BusinessSetting::where('type', 'symbol_format')->first()->value == 2) selected @endif>
                                                [Amount] [Symbol]
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <input type="hidden" name="types[]" value="no_of_decimals">
                                        <span class="input-group-text inputGroup-sizing-default">{{__('No of decimals')}}</span>
                                        <select class="form-control demo-select2-placeholder"
                                                name="no_of_decimals">
                                            <option value="0"
                                                    @if(\App\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 0) selected @endif>
                                                12345
                                            </option>
                                            <option value="1"
                                                    @if(\App\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 1) selected @endif>
                                                1234.5
                                            </option>
                                            <option value="2"
                                                    @if(\App\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 2) selected @endif>
                                                123.45
                                            </option>
                                            <option value="3"
                                                    @if(\App\BusinessSetting::where('type', 'no_of_decimals')->first()->value == 3) selected @endif>
                                                12.345
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-outline-success"
                                        type="submit">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="heading text-center">
                        <h3 class="badge badge-primary p-3 font-12">{{__('All Currency')}}</h3>
                    </div>
                    <div class="mt-2">
                        <table class="table table-striped table-bordered demo-dt-basic">
                            <thead>
                            <tr class="font-weight-bold">
                                <th>#</th>
                                <th>{{__('Currency name')}}</th>
                                <th>{{__('Currency symbol')}}</th>
                                <th>{{__('Currency code')}}</th>
                                <th>{{__('Exchange rate')}}(1 USD = ?)</th>
                                <th>{{__('Status')}}</th>
                                <th width="10%">{{__('Options')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($currencies as $key => $currency)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$currency->name}}</td>
                                    <td>{{$currency->symbol}}</td>
                                    <td>{{$currency->code}}</td>
                                    <td>{{$currency->exchange_rate}}</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_currency_status(this)"
                                                   value="{{ $currency->id }}"
                                                   type="checkbox" <?php if ($currency->status == 1) echo "checked";?> >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                                    data-toggle="dropdown" type="button">
                                                {{__('Actions')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a onclick="edit_currency_modal('{{$currency->id}}');">{{__('Edit')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_currency_modal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="currency_modal_edit" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">

        //Updates default currencies
        // function updateCurrency(i){
        //     var exchange_rate = $('#exchange_rate_'+i).val();
        //     if($('#status_'+i).is(':checked')){
        //         var status = 1;
        //     }
        //     else{
        //         var status = 0;
        //     }
        //     $.post('{{ route('currency.update') }}', {_token:'{{ csrf_token() }}', id:i, exchange_rate:exchange_rate, status:status}, function(data){
        //         location.reload();
        //     });
        // }
        //
        // //Updates your currency
        // function updateYourCurrency(i){
        //     var name = $('#name_'+i).val();
        //     var symbol = $('#symbol_'+i).val();
        //     var code = $('#code_'+i).val();
        //     var exchange_rate = $('#exchange_rate_'+i).val();
        //     if($('#status_'+i).is(':checked')){
        //         var status = 1;
        //     }
        //     else{
        //         var status = 0;
        //     }
        //     $.post('{{ route('your_currency.update') }}', {_token:'{{ csrf_token() }}', id:i, name:name, symbol:symbol, code:code, exchange_rate:exchange_rate, status:status}, function(data){
        //         location.reload();
        //     });
        // }

        function currency_modal() {
            $.get('{{ route('currency.create') }}', function (data) {
                $('#modal-content').html(data);
                $('#add_currency_modal').modal('show');
            });
        }

        function update_currency_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('currency.update_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    showAlert('success', 'Currency Status updated successfully');
                } else {
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function edit_currency_modal(id) {
            $.post('{{ route('currency.edit') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function (data) {
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endpush
