@extends('backend.body')
@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Affiliation Configs</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Affiliate System</li>
                                <li class="breadcrumb-item active">Configs</li>
                            </ol>
                        </nav>
                    </div>

                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="body">
                                <div class="col-sm-12">
                                    <div class="header">
                                        <h3 class="text-center font-14 p-3 badge badge-primary">{{__('Affiliate Registration Form')}}</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form action="{{ route('affiliate.configs.store') }}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-8 form-horizontal" id="form">
                                                    @foreach (json_decode(\App\AffiliateConfig::where('type', 'verification_form')->first()->value) as $key => $element)
                                                        @if ($element->type == 'text' || $element->type == 'file')
                                                            <div class="form-group"
                                                                 style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                                <input type="hidden" name="type[]"
                                                                       value="{{ $element->type }}">
                                                                <div class="col-md-3">
                                                                    <label class="control-label">{{ ucfirst($element->type) }}</label>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <input class="form-control" type="text"
                                                                           name="label[]"
                                                                           value="{{ $element->label }}"
                                                                           placeholder="Label">
                                                                </div>
                                                                <div class="col-lg-2"><span
                                                                            class="btn btn-icon btn-circle icon-lg fa fa-times"
                                                                            onclick="delete_choice_clearfix(this)"></span>
                                                                </div>
                                                            </div>
                                                        @elseif ($element->type == 'select' || $element->type == 'multi_select' || $element->type == 'radio')
                                                            <div class="form-group"
                                                                 style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                                <input type="hidden" name="type[]"
                                                                       value="{{ $element->type }}">
                                                                <input type="hidden" name="option[]" class="option"
                                                                       value="{{ $key }}">
                                                                <div class="col-lg-3">
                                                                    <label class="control-label">{{ ucfirst(str_replace('_', ' ', $element->type)) }}</label>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <input class="form-control" type="text"
                                                                           name="label[]"
                                                                           value="{{ $element->label }}"
                                                                           placeholder="Select Label"
                                                                           style="margin-bottom:10px">
                                                                    <div class="customer_choice_options_types_wrap_child">
                                                                        @if (is_array(json_decode($element->options)))
                                                                            @foreach (json_decode($element->options) as $value)
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-6 col-sm-offset-4">
                                                                                        <input class="form-control"
                                                                                               type="text"
                                                                                               name="options_{{ $key }}[]"
                                                                                               value="{{ $value }}"
                                                                                               required="">
                                                                                    </div>
                                                                                    <div class="col-sm-2"><span
                                                                                                class="btn btn-icon btn-circle icon-lg fa fa-times"
                                                                                                onclick="delete_choice_clearfix(this)"></span>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <button class="btn btn-success pull-right"
                                                                            type="button"
                                                                            onclick="add_customer_choice_options(this)">
                                                                        <i
                                                                                class="glyphicon glyphicon-plus"></i>
                                                                        Add option
                                                                    </button>
                                                                </div>
                                                                <div class="col-lg-2"><span
                                                                            class="btn btn-icon btn-circle icon-lg fa fa-times"
                                                                            onclick="delete_choice_clearfix(this)"></span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-lg-4">

                                                    <ul class="list-group">
                                                        <li class="list-group-item btn" style="text-align: left;"
                                                            onclick="appenddToForm('text')">{{__('Text Input')}}</li>
                                                        <li class="list-group-item btn" style="text-align: left;"
                                                            onclick="appenddToForm('select')">{{__('Select')}}</li>
                                                        <li class="list-group-item btn" style="text-align: left;"
                                                            onclick="appenddToForm('multi-select')">{{__('Multiple Select')}}</li>
                                                        <li class="list-group-item btn" style="text-align: left;"
                                                            onclick="appenddToForm('radio')">{{__('Radio')}}</li>
                                                        <li class="list-group-item btn" style="text-align: left;"
                                                            onclick="appenddToForm('file')">{{__('File')}}</li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                                            </div>
                                        </form>
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

        var i = 0;

        function add_customer_choice_options(em) {
            var j = $(em).closest('.form-group').find('.option').val();
            var str = '<div class="form-group">'
                + '<div class="col-sm-6 col-sm-offset-4">'
                + '<input class="form-control" type="text" name="options_' + j + '[]" value="" required>'
                + '</div>'
                + '<div class="col-sm-2"> <span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                + '</div>'
                + '</div>'
            $(em).parent().find('.customer_choice_options_types_wrap_child').append(str);
        }

        function delete_choice_clearfix(em) {
            $(em).parent().parent().remove();
        }

        function appenddToForm(type) {
            //$('#form').removeClass('seller_form_border');
            if (type == 'text') {
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                    + '<input type="hidden" name="type[]" value="text">'
                    + '<div class="col-lg-3">'
                    + '<label class="control-label">Text</label>'
                    + '</div>'
                    + '<div class="col-lg-7">'
                    + '<input class="form-control" type="text" name="label[]" placeholder="Label">'
                    + '</div>'
                    + '<div class="col-lg-2">'
                    + '<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                    + '</div>'
                    + '</div>';
                $('#form').append(str);
            } else if (type == 'select') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                    + '<input type="hidden" name="type[]" value="select"><input type="hidden" name="option[]" class="option" value="' + i + '">'
                    + '<div class="col-lg-3">'
                    + '<label class="control-label">Select</label>'
                    + '</div>'
                    + '<div class="col-lg-7">'
                    + '<input class="form-control" type="text" name="label[]" placeholder="Select Label" style="margin-bottom:10px">'
                    + '<div class="customer_choice_options_types_wrap_child">'

                    + '</div>'
                    + '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                    + '</div>'
                    + '<div class="col-lg-2">'
                    + '<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                    + '</div>'
                    + '</div>';
                $('#form').append(str);
            } else if (type == 'multi-select') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                    + '<input type="hidden" name="type[]" value="multi_select"><input type="hidden" name="option[]" class="option" value="' + i + '">'
                    + '<div class="col-lg-3">'
                    + '<label class="control-label">Multiple select</label>'
                    + '</div>'
                    + '<div class="col-lg-7">'
                    + '<input class="form-control" type="text" name="label[]" placeholder="Multiple Select Label" style="margin-bottom:10px">'
                    + '<div class="customer_choice_options_types_wrap_child">'

                    + '</div>'
                    + '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                    + '</div>'
                    + '<div class="col-lg-2">'
                    + '<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                    + '</div>'
                    + '</div>';
                $('#form').append(str);
            } else if (type == 'radio') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                    + '<input type="hidden" name="type[]" value="radio"><input type="hidden" name="option[]" class="option" value="' + i + '">'
                    + '<div class="col-lg-3">'
                    + '<label class="control-label">Radio</label>'
                    + '</div>'
                    + '<div class="col-lg-7">'
                    + '<input class="form-control" type="text" name="label[]" placeholder="Radio Label" style="margin-bottom:10px">'
                    + '<div class="customer_choice_options_types_wrap_child">'

                    + '</div>'
                    + '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                    + '</div>'
                    + '<div class="col-lg-2">'
                    + '<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                    + '</div>'
                    + '</div>';
                $('#form').append(str);
            } else if (type == 'file') {
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                    + '<input type="hidden" name="type[]" value="file">'
                    + '<div class="col-lg-3">'
                    + '<label class="control-label">File</label>'
                    + '</div>'
                    + '<div class="col-lg-7">'
                    + '<input class="form-control" type="text" name="label[]" placeholder="Label">'
                    + '</div>'
                    + '<div class="col-lg-2">'
                    + '<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                    + '</div>'
                    + '</div>';
                $('#form').append(str);
            }
        }
    </script>
@endpush
