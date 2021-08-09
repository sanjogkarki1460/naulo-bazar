@extends('backend.body')
@section('title',  'Purchase-History')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12">
                        <h2>   {{__('Purchase History')}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('vendor-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">   {{__('Purchase History')}}</li>
                            </ol>
                        </nav>
                    </div>
                   
                </div>
                <div class="row clearfix">

                   

  @if (count($orders) > 0)
  <!-- Order history table -->
  <div class="card">
    <div class="body">
      
        <div class="table-responsive">
            <table class="table header-border table-hover  spacing5">
                <thead>
                <tr>
                      <th>{{__('Code')}}</th>
                      <th>{{__('Date')}}</th>
                      <th>{{__('Amount')}}</th>
                      <th>{{__('Delivery Status')}}</th>
                      <th>{{__('Payment Status')}}</th>
                      <th>{{__('Options')}}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $key => $order)
                      @if (count($order->orderDetails) > 0)
                          <tr>
                              <td>
                                  <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                              </td>
                              <td>{{ date('d-m-Y', $order->date) }}</td>
                              <td>
                                  {{ single_price($order->grand_total) }}
                              </td>
                              <td>
                                  {{ ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status)) }}
                                  @if($order->viewed == 0)
                                      <span class="ml-2" style="color:green"><strong>*</strong></span>
                                  @endif
                              </td>
                              <td>
                                  <span class="badge badge--2 mr-4">
                                      @if ($order->payment_status == 'paid')
                                          <i class="bg-green"></i> {{__('Paid')}}
                                      @else
                                          <i class="bg-red"></i> {{__('Unpaid')}}
                                      @endif
                                      @if($order->payment_status_viewed == 0)
                                          <span class="ml-2" style="color:green"><strong>*</strong></span>
                                      @endif
                                  </span>
                              </td>
                              <td>
                                  <div class="dropdown">
                                      <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </button>

                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                          <button onclick="show_purchase_history_details({{ $order->id }})" class="dropdown-item">{{__('Order Details')}}</button>
                                          <a href="{{ route('customer.invoice.download', $order->id) }}" class="dropdown-item">{{__('Download Invoice')}}</a>
                                      </div>
                                  </div>
                              </td>
                          </tr>
                      @endif
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
  </div>
@endif

<div class="pagination-wrapper py-4">
  <ul class="pagination justify-content-end">
      {{ $orders->links() }}
  </ul>
</div>
</div>
</div>
</div>
</div>
</section>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
<div class="modal-content position-relative">
<div class="c-preloader">
<i class="fa fa-spin fa-spinner"></i>
</div>
<div id="order-details-modal-body">

</div>
</div>
</div>
</div>

<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
<div class="modal-content position-relative">
<div class="modal-header">
<h5 class="modal-title strong-600 heading-5">{{__('Make Payment')}}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div id="payment_modal_body"></div>
</div>
</div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
$('#order_details').on('hidden.bs.modal', function () {
location.reload();
})
</script>

@endpush