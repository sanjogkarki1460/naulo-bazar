@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>In House Sales Report</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">In House Sale Report</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Products<small>Wise Sales Report</small></h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <form class="" action="{{ route('reports.in_house_sale_report') }}" method="GET">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i
                                                            class="fa fa-tasks"></i> &nbsp;Sort By Category:</span>
                                            </div>
                                            <select id="demo-ease" class="demo-select2 form-control py-2"
                                                    name="category_id"
                                                    required>
                                                @foreach (\App\Category::all() as $key => $category)
                                                    <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-default" type="submit">Filter</button>

                                        </div>

                                    </div>
                                </form>
                                <table class="table table-striped table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Num of Sale</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ __($product->name) }}</td>
                                            <td>{{ $product->num_of_sale }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
