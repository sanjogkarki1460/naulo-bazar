@extends('frontend.body.account.index')
@section('account')
 <div class="col-md-8">
            <div class="mb-5">
                <div class="pt-5 mt-2 hidden-lg-up"></div>
                <div class="table-responsive text-sm">
                    <table class="table table-hover margin-bottom-none">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Cancel</th>
                            <th>Refund Request</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $value)           
                           <!-- Modal -->
                            <tr>
                                <td class="align-middle"><a class="text-medium navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{$value->id}}</a></td>
                                <td class="align-middle">{{($value->created_at) ? $value->created_at : $value->updated_at }}</td>
                                @if($value->order_status($value->order_status_id)->title == "cancelled")
                                <td class="align-middle"><span class="d-inline-block bg-danger text-white text-xs p-1">Canceled</span></td>
                                @elseif($value->order_status($value->order_status_id)->title == "delivered")
                                <td class="align-middle"><span class="d-inline-block bg-success text-white text-xs p-1">Delivered</span></td>
                                @elseif($value->order_status($value->order_status_id)->title == "on the way")
                                <td class="align-middle"><span class="d-inline-block bg-warning text-white text-xs p-1">On the way</span></td>
                                @elseif($value->order_status($value->order_status_id)->title == "pending")
                                <td class="align-middle"><span class="d-inline-block bg-info text-white text-xs p-1">In Progress</span></td>
                                @elseif($value->order_status($value->order_status_id)->title == "order placed")
                                <td class="align-middle"><span class="d-inline-block bg-info text-white text-xs p-1">Order Placed</span></td>
                                @endif
                                <td class="align-middle"><span class="text-medium">Rs. {{$value->total_price}}</span></td>
                                <td class="align-middle"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$value->id}}">Cancel</a></td>
                                <td class="align-middle"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#refundRequest{{$value->id}}">Request</a></td>
                            </tr>
                        <div class="modal fade" id="refundRequest{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="refundRequestLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                <form action="{{route('user.orderRefund',$value->id)}}" method="GET">
                                    <div class="modal-body">
                                         Are you sure you want refund this order?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Yes, i'm sure</button>
                                   </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          
                         
                        </tbody>
                    </table>
                </div>
                <hr class="mb-3">
                <div class="text-right"><a class="btn btn-outline-secondary mb-0" href="#"><i class="fas fa-download file_download"></i>&nbsp;Order Details</a></div>
            </div>
</div>
@endsection