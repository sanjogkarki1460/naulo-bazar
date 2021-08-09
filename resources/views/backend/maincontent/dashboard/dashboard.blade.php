@extends('backend.body')
@section('body')

<div id="main-content">
           <div class="container-fluid">
               <div class="block-header">
                   <div class="row clearfix">
                       <div class="col-md-6 col-sm-12">
                           <h1>Web Analytics</h1>
                           <nav aria-label="breadcrumb">
                               <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="#">Zhola</a></li>
                                   <li class="breadcrumb-item"><a href="#">My page</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Web Analytics</li>
                               </ol>
                           </nav>
                       </div>
                   </div>
               </div>

               <div class="row clearfix">
                   <div class="col-lg-3 col-md-6">
                       <div class="card">
                           <div class="body w_summary">
                               <div class="c_know mt-1 mr-3">
                                   <input type="text" class="knob" value="34" data-width="45" data-height="45"
                                       data-thickness="0.07" data-bgColor="#383b40" data-fgColor="#9367B4">
                               </div>
                               <div class="s_detail">
                               {{-- <h4 class="mb-0">{{$activeuser}}</h4> --}}
                                   <span>Active Users</span>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card">
                           <div class="body w_summary">
                               <div class="s_chart">
                                   <span class="chart">3,5,1,6,2,4,8,5,3,2</span>
                               </div>
                               <div class="s_detail">
                                   <h4 class="mb-0">23.15%</h4>
                                   <span>Bounce Rate</span>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card">
                           <div class="body w_summary">
                               <div class="c_know mt-1 mr-3">
                                   <input type="text" class="knob" value="57" data-width="45" data-height="45"
                                       data-thickness="0.07" data-bgColor="#383b40" data-fgColor="#9367B4">
                               </div>
                               <div class="s_detail">
                                   <h4 class="mb-0">{{$total_page_sum}}</h4>
                                   <span>Pages/Session</span>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card">
                           <div class="body w_summary">
                               <div class="s_chart">
                                   <span class="chart">8,5,2,9,6,3,4,5,6,7</span>
                               </div>
                               <div class="s_detail">
                                   <h4 class="mb-0">{{$total_visitor_sum}}</h2>
                                       <span>Visitors</span>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row clearfix">
                   <div class="col-sm-12">
                       <div class="card">
                           <div class="body">
                               <div class="d-flex justify-content-between align-items-center">
                                   <div>
                                       <h6 class="mb-0">Audience Metrics</h6>
                                   </div>
                                   <ul class="nav nav-tabs2">
                                       <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#today">Today</a></li>
                                       <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#t-week">Week</a></li>
                                       <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#t-month">Month</a></li>
                                   </ul>
                               </div>
                               <div class="row clearfix">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                       <small>Audience It is a long established fact that a reader will be distracted</small>
                                       <div class="d-flex justify-content-start mt-3">
                                           <div class="mr-5">
                                               <label class="mb-0">Users Visitor</label>
                                           <h4>{{number_format($analyticsMonthly)}}</h4>
                                           </div>
                                           <div>
                                               <label class="mb-0">Sessions</label>
                                           <h4>{{number_format($total_page_sum)}}</h4>
                                           </div>
                                       </div>
                                       <div id="chart-donut-analytics" style="height: 250px"></div>
                                   </div>
                                   <div class="col-lg-8 col-md-12 col-sm-12">
                                       <div id="flotChart-analytics" class="flot-chart"></div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-12 col-md-12">
                       <div class="card">
                           <div class="header">
                               <h2>Browser Session</h2>
                           </div>
                           <div class="body">
                               <canvas id="pieChart" width="400" height="400"></canvas>

                           </div>
                       </div>
                   </div>
                   <div class="col-lg-12 col-md-6">
                       <div class="card">
                           <div class="header">
                               <h2>Pages</h2>
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
   $(function() {
"use strict";
   c3.generate({
       bindto: '#chart-donut-analytics', // id of chart wrapper

       data: {
           columns: [
               // each columns data
               ['data1', {{$total_page_sum}}],
               ['data2', {{$analyticsMonthly}}]
           ],
           type: 'donut', // default type of chart
           colors: {
               'data1': '#9367B4',
               'data2': '#17C2D7',
           },
           names:
           {
               // name of each serie
               'data1': 'Sessions',
               'data2': 'User Visitor'
           }
       },
       axis: {
       },
       legend: {
           show: false, //hide legend
       },
       padding: {
           bottom: 20,
           top: 0
       },
   });


});
$(function() {
   "use strict";
       var plot = $.plot('#flotChart-analytics', [{
           data: flotSampleData1,
           color: '#9367B4',
           lines: {
           fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
           }
       },{
           data: flotSampleData2,
           color: '#17C2D7',
           lines: {
           fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
           }
       }],
       {
           series: {
               shadowSize: 0,
               lines: {
                   show: true,
                   lineWidth: 2,
                   fill: true
               }
           },
           grid: {
               borderWidth: 0,
               labelMargin: 8
           },
           yaxis:
           {
               show: true,
                       min: 0,
                       max: 100,
                   ticks: [[0,''],[0,'14K'],[40,'37K'],[60,'49K'],[80,'68K']],

           },
           xaxis: {
               show: true,
               ticks: [[25,'JAN 21'],[50,'JAN 22'],[75,'JAN 23'],[100,'JAN 24']],
           }
       });
});
</script>
<script>
   var pieChart = document.getElementById('pieChart')
   console.log("HEIGHT",pieChart.height);
   var ctx = pieChart.getContext('2d');
   var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: {!! $productStock->pluck('browser') !!},
           datasets: [{
               label: '# of Session',
               data: {!! $productStock->pluck('sessions') !!},
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
               @foreach($viewsData as $order)
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