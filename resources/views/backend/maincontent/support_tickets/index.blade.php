@extends('backend.body')
@section('body')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <h2>Support Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Support</li>
                                <li class="breadcrumb-item active">Ticket Lists</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                        <a href="#"  data-toggle="modal" data-target="#ticket_modal"
                           class="btn btn-rounded btn-info pull-right">{{ __('Create a Ticket') }}</a>
                    </div>
              
                </div>
                <div class="row clearfix">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="card">
                        <div class="body">

                            <div class="panel">
                                <div class="panel-heading bord-btm clearfix pad-all h-100">
                                    <h3 class="badge badge-primary p-3 font-12">{{__('Support Desk')}}</h3>
                                    @if(Auth::user()->hasRole('admin'))
                              
                                    <div class="pull-right clearfix">
                                        <form class="" id="sort_support" action="" method="GET">
                                            <div class="box-inline pad-rgt pull-left">
                                                <div class="" style="min-width: 300px;">
                                                    <input type="text" class="form-control" id="search" name="search"
                                                           @isset($sort_search) value="{{ $sort_search }}"
                                                           @endisset placeholder="Type ticket code & Enter">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                              
                                <div class="panel-body">
                                    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Ticket ID') }}</th>
                                            <th>{{ __('Sending Date') }}</th>
                                            <th>{{ __('Subject') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Last reply') }}</th>
                                            <th>{{ __('Options') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($tickets as $key => $ticket)
                                            @if ($ticket->user != null)
                                                <tr>
                                                    <td>#{{ $ticket->code }}</td>
                                                    <td>{{ $ticket->created_at }} @if($ticket->viewed == 0) <span
                                                                class="pull-right badge badge-info">{{ __('New') }}</span> @endif
                                                    </td>
                                                    <td>{{ $ticket->subject }}</td>
                                                    <td>{{ $ticket->user->name }}</td>
                                                    <td>
                                                        @if ($ticket->status == 'pending')
                                                            <span class="badge badge-pill badge-danger">Pending</span>
                                                        @elseif ($ticket->status == 'open')
                                                            <span class="badge badge-pill badge-secondary">Open</span>
                                                        @else
                                                            <span class="badge badge-pill badge-success">Solved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (count($ticket->ticketreplies) > 0)
                                                            {{ $ticket->ticketreplies->last()->created_at }}
                                                        @else
                                                            {{ $ticket->created_at }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('support_ticket.admin_show', encrypt($ticket->id))}}"
                                                           class="btn-link btn btn-outline-info">{{__('View Details')}}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="clearfix">
                                        <div class="pull-right">
                                            {{ $tickets->appends(request()->input())->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" name="details" placeholder="Type your reply"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>Attach files.</span>
                        </label>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
