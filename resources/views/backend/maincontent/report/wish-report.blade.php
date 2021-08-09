@extends('backend.body')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Wishlist Report</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ol>
                    </nav>
                </div>            
            </div>
        </div>
        
        <div class="row clearfix justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>Wishlist<small>Wishlist Report</small></h2>
                  
                    </div>
					  <form class="" action="{{ url('/report/wishlist') }}" method="GET">
                                <div class="d-flex justify-content-center">
                                    <div class="mr-3 py-2">
                                        <p class="bold">Sort By
                                            Category
                                        </p>
                                    </div>
                                    <div class="select">
                                        <select id="demo-ease" class="demo-select2" name="category_id" required>
                         @foreach (\App\Category::all() as $key => $category)
                             <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                         @endforeach
                     </select>
                                    </div>
                                    <div class="ml-4">
                                        <button class="btn btn-primary text-right" type="submit">Filter
                                        </button>
                                    </div>
                                </div>

                            </form>
					
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Number of Wishlist</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                          <th>Product Name</th>
                                <th>Number of Wish</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                @if($product->wishlists != null)
                                    <tr>
                                        <td>{{ __($product->name) }}</td>
                                        <td>{{ $product->wishlists->count() }}</td>
                                    </tr>
                                @endif
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