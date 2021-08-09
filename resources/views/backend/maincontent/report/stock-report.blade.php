@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Stock Report</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Wise Stock Report</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="header">
                                <h2>Stock<small class="badge badge-primary p-3 font-12">Product Wise Stock Report</small></h2>
                            </div>

                            <form class="" action="{{ route('reports.stock') }}" method="GET">
                                <div class="d-flex justify-content-center">
                                    <div class="mr-3 py-2">
                                        <p class="bold">Sort By
                                            Category
                                        </p>
                                    </div>
                                    <div class="select">
                                        <select id="demo-ease" class="form-control" name="category_id" required>
                                            @foreach (\App\Models\Category::all() as $key => $category)
                                                <option value="{{ $category->id }}" {{isset($selectedCategory) && $category->id == $selectedCategory ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ml-4">
                                        <button class="btn btn-outline-secondary text-right" type="submit">Filter
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>


                </div>


            </div>

            <div class="row clearfix justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Stock</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Stock</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($products as $key => $product)
                                        @php
                                            $qty = 0;
                                            if ($product->variant_product) {
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else {
                                                $qty = $product->current_stock;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ __($product->name) }}</td>
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

        </div>
    </div>
@endsection