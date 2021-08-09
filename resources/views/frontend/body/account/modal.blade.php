<div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form action="{{route('user.ordercancelled',$value->id)}}" method="GET">
                    <div class="modal-body">
                    Are you sure you want to cancel this order?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes, i'm sure</button>
                </form>
            </div>
    </div>
</div>
{{-- <div class="modal fade" id="refundRequest{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="refundRequestLabel" aria-hidden="true">
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
</div> --}}