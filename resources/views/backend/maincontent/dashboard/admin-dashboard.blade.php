@extends('backend.body')
@section('body')
     <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Dashboard </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>


            @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="bg-danger pad-all text-center p-3">
                            <h4 class="text-light mar-btm">{{__('Please Configure SMTP Setting to work all email sending functionality')}}
                                .</h4>
                            <a class="btn btn-info btn-rounded" href="{{ route('smtp_settings.index') }}">Configure
                                Now</a>
                        </div>
                    </div>
                </div>
            @endif
            @if(Auth::user()->user_type == ('admin') )
                <div class="row">
                    <div class="col-md-6 card">
                        <div class="body">
                            <div class="text-center dash-widget dash-widget-left">
                                <!--<div class="dash-widget-vertical">-->
                            <!--    <div class="rorate">{{__('PRODUCTS')}}</div>-->
                                <!--</div>-->
                                <div class="dash_title h3 badge badge-primary p-3 font-14"><b>{{__('PRODUCTS')}}</b>
                                </div>
                                <div class="pad-ver mar-top text-main">
                                    <i class="demo-pli-data-settings icon-4x"></i>
                                </div>
                                <br>
                                <p class="text-large text-main">{{__('Total published products')}}: <span
                                            class="font-weight-bold">{{ \App\Product::where('published', 1)->get()->count() }}</span>
                                </p>
                                @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                    <p class="text-large text-main">{{__('Total sellers products')}}: <span
                                                class="font-weight-bold">{{ \App\Product::where('published', 1)->where('added_by', 'vendor')->get()->count() }}</span>
                                    </p>
                                @endif
                                <p class="text-large text-main">{{__('Total admin products')}}: <span
                                            class="font-weight-bold">{{ \App\Product::where('published', 1)->where('added_by', 'admin')->get()->count() }}</span>
                                </p>
                                <a href="{{ route('products.admin') }}" class="btn btn-primary mar-top">Manage Products
                                    <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 card">
                        <div class="row body">
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <div class="pad-top text-center dash-widget">
                                        <span class="badge badge-primary font-12 mb-2"><b>{{__('Total product category')}}</b></span>
                                        <p class="font-weight-bold font-20 text-main">{{ \App\Category::all()->count() }}</p>
                                        <a href="{{ route('categories.create') }}"
                                           class="btn btn-primary mar-top btn-block top-border-radius-no">{{__('Create Category')}}</a>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="pad-top text-center dash-widget">
                                        <span class="badge badge-primary font-12 mb-2"><b>{{__('Total product sub sub category')}}</b></span>
                                        <p class="font-weight-bold font-20 text-main">{{ \App\SubSubCategory::all()->count() }}</p>
                                        <a href="{{ route('subsubcategories.create') }}"
                                           class="btn btn-primary mar-top btn-block top-border-radius-no">{{__('Create Sub Sub Category')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel">
                                    <div class="pad-top text-center dash-widget">
                                        <span class="badge badge-primary font-12 mb-2"><b>{{__('Total product sub category')}}</b></span>
                                        <p class="font-weight-bold font-20 text-main">{{ \App\SubCategory::all()->count() }}</p>
                                        <a href="{{ route('subcategories.create') }}"
                                           class="btn btn-primary mar-top btn-block top-border-radius-no">{{__('Create Sub Category')}}</a>
                                    </div>
                                </div>
                                <div class="panel mt-4 ml-5">
                                    <div class="pad-top text-center dash-widget">
                                        <p class="badge badge-primary font-12 mb-2"><b>{{__('Total product brand')}}</b>
                                        </p>
                                        <p class="font-weight-bold font-20 text-main">{{ \App\Brand::all()->count() }}</p>
                                        <a href="{{ route('brands.create') }}"
                                           class="btn btn-primary mar-top btn-block top-border-radius-no">{{__('Create Brand')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="header text-center bg-info mb-2">
                <span class="font-weight-bold font-35">{{__('SELLERS')}}</span>
            </div>
            <div class="card">
                <div class="body">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="card">
                                <div class="body text-center dash-widget dash-widget-left">
                                    <br>
                                    <p class="badge badge-primary font-12 font-weight-bold">{{__('Total sellers')}}</p>
                                    <p class="font-weight-bold font-20 text-main">{{ \App\Seller::all()->count() }}</p>
                                    <br>
                                    <a href="{{ route('sellers.index') }}" class="btn-link">{{__('Manage Sellers')}} <i
                                                class="fa fa-long-arrow-right"></i></a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="body text-center dash-widget">
                                    <br>
                                    <p class="badge badge-primary font-12 font-weight-bold">{{__('Total approved sellers')}}</p>
                                    <p class="font-weight-bold font-20 text-main">{{ \App\Seller::where('verification_status', 1)->get()->count() }}</p>
                                    <br>
                                    <a href="{{ route('sellers.index') }}" class="btn-link">{{__('Manage Sellers')}} <i
                                                class="fa fa-long-arrow-right"></i></a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="body text-center dash-widget">
                                    <br>
                                    <p class="badge badge-primary font-12 font-weight-bold">{{__('Total pending sellers')}}</p>
                                    <p class="font-weight-bold font-20 text-main">{{ \App\Seller::where('verification_status', 0)->count() }}</p>
                                    <br>
                                    <a href="{{ route('sellers.index') }}" class="btn-link">{{__('Manage Sellers')}} <i
                                                class="fa fa-long-arrow-right"></i></a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if(Auth::user()->user_type == ('admin'))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <!--Panel heading-->
                                    <div class="body text-center">
                                        <span class="badge badge-primary font-12 p-3 font-weight-bold text-center h3">{{__('Category wise product sale')}}</span>
                                    </div>

                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped bord">
                                                <thead class="text-bold">
                                                <tr>
                                                    <th>{{__('Category Name')}}</th>
                                                    <th>{{__('Sale')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach (\App\Category::all() as $key => $category)
                                                    <tr>
                                                        <td>{{ __($category->name) }}</td>
                                                        <td>{{ \App\Product::where('category_id', $category->id)->sum('num_of_sale') }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <!--Panel heading-->
                                    <div class="body text-center">
                                        <span class="badge badge-primary font-12 p-3 font-weight-bold text-center h3">{{__('Category wise product stock')}}</span>
                                    </div>

                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mar-no">
                                                <thead>
                                                <tr>
                                                    <th>{{__('Category Name')}}</th>
                                                    <th>{{__('Stock')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach (\App\Category::all() as $key => $category)
                                                    @php
                                                        $products = \App\Product::where('category_id', $category->id)->get();
                                                        $qty = 0;
                                                        foreach ($products as $key => $product) {
                                                            if ($product->variant_product) {
                                                                foreach ($product->stocks as $key => $stock) {
                                                                    $qty += $stock->qty;
                                                                }
                                                            }
                                                            else {
                                                                $qty = $product->current_stock;
                                                            }
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ __($category->name) }}</td>
                                                        <td>{{ $qty }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>


    @endsection

