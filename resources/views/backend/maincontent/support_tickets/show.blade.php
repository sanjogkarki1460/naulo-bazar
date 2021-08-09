@extends('backend.body')

@section('body')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-6 col-sm-12 mb-4">
                        <h2>Support Section</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Support</li>
                                <li class="breadcrumb-item active">View Ticket</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row clearfix">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="card">
                        <div class="body">
                            <div class="pad-all bg-gray-light">
                                <h3 class="text-capitalize badge badge-dark p-3 font-12">{{ $ticket->subject }}
                                    #{{ $ticket->code }}</h3>
                                <hr class="bg-info">
                                <ul class="mar-top list-inline ml-2">
                                    <li class="pb-2">{{ $ticket->user->name }}</li>
                                    <li class="pb-2">{{ $ticket->created_at }}</li>
                                    <li>
                                        <span class="badge badge-pill badge-secondary">{{ ucfirst($ticket->status) }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="panel-body">
                                <form class="" action="{{ route('support_ticket.admin_store') }}" method="post"
                                      id="ticket-reply-form"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                                    <input type="hidden" name="status" value="{{ $ticket->status }}" required>
                                    <div class="form-group">
                       <textarea class="form-control summernote" name="reply"
                                 aria-label="Default"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="attachments[]" class="form-control" multiple>
                                    </div>
                                    <div class="form-group text-right pos-rel">
                                        <button type="button" class="btn btn-primary"
                                                onclick="submit_reply('pending')">Submit as
                                            <strong>{{ ucfirst($ticket->status) }}</strong></button>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li onclick="submit_reply('open')"><a href="#">Submit as
                                                    <strong>Open</strong></a>
                                            </li>
                                            <li onclick="submit_reply('solved')"><a href="#">Submit as
                                                    <strong>Solved</strong></a>
                                            </li>
                                            <!-- default new ticket status pending. after admin first reply it will be open -->
                                        </ul>
                                    </div>
                                </form>
                                <div class="pad-top">
                                    @foreach($ticket->ticketreplies as $ticketreply)
                                        <div class="media bord-top pad-top">
                                            <a class="media-left" href="#">
                                                @if($ticketreply->user->avatar_original === null)
                                                    <img class="img-circle img-sm"
                                                         src="{{ asset($ticketreply->user->avatar_original) }}">
                                                @else
                                                    <img class="img-circle img-sm"
                                                         src="{{ asset('frontend/images/user.png') }}">
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <div class="comment-header">
                                                    <a href="#"
                                                       class="media-heading box-inline text-main text-bold">{{ $ticketreply->user->name }}</a>
                                                    <p class="text-muted text-sm">{{$ticketreply->created_at}}</p>
                                                </div>
                                                <div>
                                                    @php
                                                        echo $ticketreply->reply;
                                                    @endphp
                                                    @if($ticketreply->files != null && is_array(json_decode($ticketreply->files)))
                                                        <div>
                                                            @foreach (json_decode($ticketreply->files) as $key => $file)
                                                                <div>
                                                                    <a href="{{ asset($file->path) }}"
                                                                       download="{{ $file->name }}"
                                                                       class="support-file-attach bg-gray pad-all rounded">
                                                                        <i class="fa fa-link mar-rgt"></i> {{ $file->name }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="media bord-top pad-top">
                                        <a class="media-left" href="#"><img loading="lazy"
                                                                            class="img-circle img-sm"
                                                                            alt="Profile Picture"
                                                                            src="{{ asset($ticket->user->avatar_original) }}">
                                        </a>
                                        <div class="media-body">
                                            <div class="comment-header">
                                                <a href="#"
                                                   class="media-heading box-inline text-main text-bold">{{ $ticket->user->name }}</a>
                                                <p class="text-muted text-sm">{{$ticket->created_at}}</p>
                                            </div>
                                            <p>
                                            @php
                                                echo $ticket->details;
                                            @endphp
                                            @if($ticket->files != null && is_array(json_decode($ticket->files)))
                                                <div>
                                                    @foreach (json_decode($ticket->files) as $key => $file)
                                                        <div>
                                                            <a href="{{ asset($file->path) }}"
                                                               download="{{ $file->name }}"
                                                               class="support-file-attach bg-gray pad-all rounded">
                                                                <i class="fa fa-link mar-rgt"></i> {{ $file->name }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                                </p>
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
@endsection

@push('scripts')
    <script type="text/javascript">
        function submit_reply(status) {
            $('input[name=status]').val(status);
            if ($('textarea[name=reply]').val().length > 0) {
                $('#ticket-reply-form').submit();
            }
        }
    </script>
@endpush
