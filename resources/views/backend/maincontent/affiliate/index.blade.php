@extends('backend.body')

@section('body')


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>Affiliation Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Affiliate System</li>
                                <li class="breadcrumb-item active">Basic Affiliate</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <div class="container mt-4">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="card">

                                <form class="form-horizontal" action="{{ route('affiliate.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="user_registration_first_purchase">


                                    <article class="media body mb-0">

                                        <div class="media-body">
                                            <div class="text-center">
                                                <p class=""><span
                                                            class="badge badge-primary text-center">Basic Affiliate</span>
                                                </p>
                                            </div>

                                            @php
                                                if(\App\AffiliateOption::where('type', 'user_registration_first_purchase')->first() != null){
                                                    $percentage = \App\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage;
                                                    $status = \App\AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status;
                                                }
                                                else {
                                                    $percentage = null;
                                                }
                                            @endphp
                                            <div class="content">

                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text text-wrap font-weight-bold"
                                                               id=""> &nbsp;User
                                                            Registration &
                                                            First Purchase</label>
                                                    </div>
                                                    <input type="number" min="0" step="0.01" max="100"
                                                           class="form-control"
                                                           name="percentage" value="{{ $percentage }}"
                                                           placeholder="Percentage of Order Amount" required>
                                                    <div class="span p-1 font-weight-bold">
                                                        %
                                                    </div>

                                                </div>

                                                <div class="input-group-prepend">
                                                    <label class="input-group-text font-weight-bold" id="">
                                                        &nbsp;Status</label>

                                                    <div class="text-right pt-2 pl-5">
                                                        <label class="switch">
                                                            <input value="1" name="status" type="checkbox" @if ($status)
                                                            checked
                                                                    @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12 text-right">
                                                    <button class="btn btn-success"
                                                            type="submit">{{__('Save')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <form class="form-horizontal" action="{{ route('affiliate.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="product_sharing">


                                    <article class="media body mb-0">

                                        <div class="media-body">
                                            <div class="text-center">
                                                <p class=""><span
                                                            class="badge badge-primary text-center">Product Sharing Affiliate</span>
                                                </p>
                                            </div>


                                            @php
                                                if(\App\AffiliateOption::where('type', 'product_sharing')->first() != null && \App\AffiliateOption::where('type', 'product_sharing')->first()->details != null){
                                                    $commission_product_sharing = json_decode(\App\AffiliateOption::where('type', 'product_sharing')->first()->details)->commission;
                                                    $commission_type_product_sharing = json_decode(\App\AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type;
                                                    $status = \App\AffiliateOption::where('type', 'product_sharing')->first()->status;
                                                }
                                                else {
                                                    $commission_product_sharing = null;
                                                    $commission_type_product_sharing = null;
                                                }
                                            @endphp
                                            <div class="content">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text font-weight-bold" id=""> &nbsp;Product
                                                            Sharing and Purchasing</label>
                                                    </div>
                                                    <input type="number" min="0" step="0.01" max="100"
                                                           class="form-control"
                                                           name="amount" value="{{ $commission_product_sharing }}"
                                                           placeholder="Percentage of Order Amount" required>

                                                    <div class="span p-1 font-weight-bold">
                                                        %
                                                    </div>

                                                </div>


                                                <div class="input-group-prepend">
                                                    <label class="input-group-text font-weight-bold" id="">
                                                        &nbsp;Status</label>

                                                    <div class="text-right pt-2 pl-5">
                                                        <label class="switch">
                                                            <input value="1" name="status" type="checkbox" @if ($status)
                                                            checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12 text-right">
                                                    <button class="btn btn-success"
                                                            type="submit">{{__('Save')}}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </article>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="body">
                            <div class="text-center">
                                <p class=""><span
                                            class="badge badge-primary text-center">Product Sharing Affiliate</span>
                                    <span
                                            class="badge-dark">Category Wise</span>
                                </p>
                            </div>
                            <form class="form-horizontal" action="{{ route('affiliate.store') }}" method="POST">
                                @csrf
                                @php
                                    if(\App\AffiliateOption::where('type', 'category_wise_affiliate')->first() != null){
                                        $category_wise_affiliate_status = \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status;
                                    }
                                @endphp
                                <div class="input-group-prepend">
                                    <label class="input-group-text font-weight-bold" id="">
                                        &nbsp;Status</label>


                                    <div class="text-right pt-2 pl-5">
                                        <label class="switch">
                                            <input value="1" name="status" type="checkbox"
                                                   @if ($category_wise_affiliate_status)
                                                   checked
                                                    @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                </div>
                                <hr class="bg-info">
                                @if (\App\AffiliateOption::where('type', 'category_wise_affiliate')->first() != null)
                                    <input type="hidden" name="type" value="category_wise_affiliate">
                                    @foreach (\App\Category::all() as $key => $category)
                                        @php
                                            $found = false;
                                        @endphp
                                        @if(\App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->details != null)
                                            @foreach (json_decode(\App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->details) as $key => $data)
                                                @if($data->category_id == $category->id)
                                                    @php
                                                        $found = true;
                                                        $value = $data;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($found)

                                            <div class="row m-1 py-2">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-sm mb-4">
                                                        <div class="input-group-prepend">
                                                            <input type="hidden"
                                                                   name="categories_id_{{ $value->category_id }}"
                                                                   value="{{ $value->category_id }}">
                                                            <input type="text" class="form-control"
                                                                   value="{{ \App\Category::find($value->category_id)->name }}"
                                                                   readonly>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group-prepend col-md-4">

                                                    <input type="number" min="0" step="0.01" class="form-control"
                                                           name="commison_amounts_{{ $value->category_id }}"
                                                           value="{{ $value->commission }}">
                                                </div>
                                                <div class="p-2">
                                                    <select class="demo-select2"
                                                            name="commison_types_{{ $value->category_id }}">
                                                        <option value="amount"
                                                                @if($value->commission_type == 'amount') selected @endif>
                                                            $
                                                        </option>
                                                        <option value="percent"
                                                                @if($value->commission_type == 'percent') selected @endif>
                                                            %
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row m-1 py-2">
                                                <div class="input-group-prepend col-md-6">

                                                    <input type="hidden" name="categories_id_{{ $category->id }}"
                                                           value="{{ $category->id }}">
                                                    <input type="text" class="form-control"
                                                           value="{{ $category->name }}"
                                                           readonly>

                                                </div>
                                                <div class="col-md-4">

                                                    <input type="number" min="0" step="0.01" class="form-control"
                                                           name="commison_amounts_{{ $category->id }}" value="0">
                                                </div>
                                                <div class="col-md-4 p-2">
                                                    <select class="demo-select2 form-control"
                                                            name="commison_types_{{ $category->id }}">
                                                        <option value="amount">$</option>
                                                        <option value="percent">%</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
