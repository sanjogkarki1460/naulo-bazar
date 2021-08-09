@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h1>Seller Report</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seller Based Seller</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row clearfix justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Seller<small>Seller Based Selling Report</small></h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <form class="" action="{{route('reports.seller.based')}}" method="GET">
                                    <div class="d-flex justify-content-center">
                                        <div class="mr-3 py-2">
                                            <p class="bold">Sort By
                                                Verification Status
                                            </p>
                                        </div>
                                        <div class="select py-2">
                                            <select class="demo-select2" name="verification_status" required>
                                                <option value="1"{{isset($status) && $status == '1' ? 'selected' : ''}}>
                                                    Approved
                                                </option>
                                                <option value="0" {{isset($status) && $status == '0' ? 'selected' : ''}}>
                                                    Not Approved
                                                </option>
                                            </select>
                                        </div>
                                        <div class="ml-4">
                                            <button class="btn btn-outline-info text-right" type="submit">Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-striped table-hover dataTable">
                                    <thead>
                                    <tr>
                                        <th><b>Seller Name</b></th>
                                        <th><b>Shop Name</b></th>
                                        <th><b>No. Of Product Sale</b></th>
                                        <th><b>Order Amount</b></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th><b>Seller Name</b></th>
                                        <th><b>Shop Name</b></th>
                                        <th><b>No. Of Product Sale</b></th>
                                        <th><b>Order Amount</b></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($sellers as $key => $seller)
                                @if($seller->user != null)
                                    <tr>
                                        <td>{{ $seller->user->name }}</td>
                                        <td>{{ $seller->user->shop->name }}</td>
                                        <td>
                                            @php
                                                $num_of_sale = 0;
                                                foreach ($seller->user->products as $key => $product) {
                                                    $num_of_sale += $product->num_of_sale;
                                                }
                                            @endphp
                                            {{ $num_of_sale }}
                                        </td>
                                        <td>
                                            {{ single_price(\App\OrderDetail::where('seller_id', $seller->user->id)->sum('price')) }}
                                        </td>
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