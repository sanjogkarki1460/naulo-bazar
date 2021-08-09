@extends('backend.body')

@section('body')


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Refund Request</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">Sent Refund Request</a></li>
                           
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{url()->previous()}}"
                       class="btn btn-sm btn-primary btn-round" title="">Go Back</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="body">

 
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="heading heading-6 text-capitalize strong-600 mb-0 d-inline-block font-12 p-3 badge badge-primary">
                                        {{__('Conversations')}}
                                    </h2>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card no-border mt-4 p-3">
                            <div class="py-4">
                                @foreach ($conversations as $key => $conversation)
                                    <div class="block block-comment border-bottom">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="block-image">
                                                    @if (Auth::user()->id == $conversation->sender_id)
                                                        <img @if ($conversation->receiver->avatar_original == null) src="{{ asset('frontend/images/user.png') }}" @else src="{{ asset($conversation->receiver->avatar_original) }}" @endif class="rounded-circle">
                                                    @else
                                                        <img @if (@$conversation->sender->avatar_original == null) src="{{ asset('frontend/images/user.png') }}" @else src="{{ asset($conversation->sender->avatar_original) }}" @endif class="rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <p>
                                                    @if (Auth::user()->id == $conversation->sender_id)
                                                        <a href="javascript:;">{{ $conversation->receiver->name }}</a>
                                                    @else
                                                        <a href="javascript:;">{{ @$conversation->sender->name }}</a>
                                                    @endif
                                                    <br>
                                                    <span class="comment-date">
                                                        {{ date('h:i:m d-m-Y', strtotime(@$conversation->messages->last()->created_at)) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-9">
                                                <div class="block-body">
                                                    <div class="block-body-inner pb-3">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <h4 class="heading heading-6">
                                                                    <a href="{{ route('conversations.show', encrypt($conversation->id)) }}">
                                                                        {{ $conversation->title }}
                                                                    </a>
                                                                    @if ((Auth::user()->id == $conversation->sender_id && $conversation->sender_viewed == 0) || (Auth::user()->id == $conversation->receiver_id && $conversation->receiver_viewed == 0))
                                                                        <span class="badge badge-pill badge-danger">{{ __('New') }}</span>
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <p class="comment-text mt-0">
                                                            {{ @$conversation->messages->last()->message }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $conversations->links() }}
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
