@extends('backend.body')
@section('body')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Jhola</a></li>
                        <li class="breadcrumb-item"><a href="#">My Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Report</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="w_summary">
                            <div class="s_chart">
                                <span class="chart">5,2,3,6,9,8,4,1,2,8</span>
                            </div>
                            <div class="s_detail">
                                <h2 class="font700 mb-0">$15K</h2>
                                <span>67% <i class="fa fa-level-up text-success"></i> Total income</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="w_summary">
                            <div class="s_chart">
                                <span class="chart">6,3,2,5,8,9,5,4,2,3</span>
                            </div>
                            <div class="s_detail">
                                <h2 class="font700 mb-0">$1258</h2>
                                <span>15% <i class="fa fa-level-up text-success"></i> Total Expense</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="w_summary">
                            <div class="s_chart">
                                <span class="chart">3,5,1,6,2,4,8,5,3,2</span>
                            </div>
                            <div class="s_detail">
                                <h2 class="font700 mb-0">$2315</h2>
                                <span>23% <i class="fa fa-level-up text-success"></i> Total Growth</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="w_summary">
                            <div class="s_chart">
                                <span class="chart">8,5,2,9,6,3,4,5,6,7</span>
                            </div>
                            <div class="s_detail">
                                <h2 class="font700 mb-0">$1025</h2>
                                <span>52% <i class="fa fa-level-up text-success"></i> Bounce Rate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Product Stock</h2>
                    </div>
                    <div class="body">
                        <canvas id="pieChart" width="400" height="400"></canvas>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Sales Revenue</h2>
                    </div>
                    <div class="body text-center">
                        <canvas id="line_chart" style="width: 900px; height: 500px"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    var pieChart = document.getElementById('pieChart')
    console.log("HEIGHT",pieChart.height);
    var ctx = pieChart.getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $productStock->pluck('title') !!},
            datasets: [{
                label: '# of Stock',
                data: {!! $productStock->pluck('stock') !!},
                backgroundColor: {!! $productStock->pluck('color') !!},
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
                    maintainAspectRatio: false,
                }
    });
    </script>
<script>
    var lineChart = document.getElementById('line_chart')
    console.log("HEIGHT",lineChart.height);
    var lCtx = lineChart.getContext('2d');
    var lChart = new Chart(lCtx, {
        type: 'line',
        data: {
            labels: ["Jan","Feb","March","April","May", "June", "July", "Aug", "Sept","Oct", "Nov","Dec"],
            datasets: [
                @foreach($orders as $order)
                {
					label: "{{ $order['name'] }}",
					fill: false,
					backgroundColor: "{{ $order['color'] }}",
					borderColor: "{{ $order['borderColor'] }}",
					data: {!! $order['monthData'] !!}
				},
                @endforeach
            ]
        },
        options: {
                    maintainAspectRatio: false,
                }
    });
    </script>



@endpush
