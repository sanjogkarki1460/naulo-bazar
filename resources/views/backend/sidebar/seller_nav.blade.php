
<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{ route('vendor-dashboard') }}">
			<img src="{{ asset('backend/assets/images/logo.png') }}"
                                                      alt="zholaa Logo"
                                                      class="" style="width: 70%"></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                    class="lnr lnr-menu icon-close"></i></button>
    </div>
    <br>
    <div class="sidebar-scroll">
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                <li>
                    <a href="{{ route('vendor-dashboard') }}" class="{{ areActiveRoutesHome(['vendor-dashboard'])}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="category-name">
                            {{__('Dashboard')}}
                        </span>
                    </a>
                </li>
                

                <li class="{{ areActiveRoutesHome(['shops.index']) ? 'active' : '' }}">
                    <a href="{{ route('shops.index') }}"> <i class="fa fa-dashboard"></i> {{__('Shop Setting')}}</a>
                </li>
              
                 
              
                <li class="{{ Request::is('product*') ? 'active' : '' }}">
                    <a href="{{route('products.seller')}}"><i class="fa fa-product-hunt"></i><span>Product</span></a>
                  
                </li>


                @php
                $review_count = DB::table('reviews')
                            ->orderBy('code', 'desc')
                            ->join('products', 'products.id', '=', 'reviews.product_id')
                            ->where('products.user_id', Auth::user()->id)
                            ->where('reviews.viewed', 0)
                            ->select('reviews.id')
                            ->distinct()
                            ->count();
            @endphp
            <li class="{{ areActiveRoutesHome(['reviews.seller']) ? 'active': ''}}">
                <a href="{{ route('reviews.seller') }}">
                    <i class="fa fa-comments"></i>
                    <span class="category-name">
                        {{__('Product Reviews')}}@if($review_count > 0)<span class="ml-2" style="color:green"><strong>({{ $review_count }} {{ __('New') }})</strong></span>@endif
                    </span>
                </a>
            </li>

                @php
                $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('viewed', 0)->get()->count() ?? 0;
                $payment_status_viewed = 0;
                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
            @endphp

                <li  class="{{ areActiveRoutesHome(['purchase_history.index'])}}">
                    <a href="{{ route('purchase_history.index') }}">
                        <i class="fa fa-history"></i>
                        <span class="category-name">
                            {{__('Purchase History')}} @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="ml-2" style="color:green"><strong>({{ __(' New Notifications') }})</strong></span>@endif
                        </span>
                    </a>
                </li>


                @php
                $orders = DB::table('orders')
                            ->orderBy('code', 'desc')
                            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                            ->where('order_details.seller_id', Auth::user()->id)
                            ->where('orders.viewed', 0)
                            ->select('orders.id')
                            ->distinct()
                            ->count();
            @endphp

            
            <li class="{{ areActiveRoutesHome(['orders.index'])}}">
                <a href="{{ route('orders.index') }}">
                    <i class="fa fa-first-order"></i>
                    <span class="category-name">
                        {{__('Orders')}} @if($orders > 0)<span class="ml-2" style="color:green"><strong>({{ $orders }} {{ __('New') }})</strong></span></span>@endif
                    </span>
                </a>
            </li>

            
        

             
                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                <li class="{{ areActiveRoutesHome(['vendor_refund_request'])}}">
                    <a href="{{ route('vendor_refund_request') }}">
                        <i class="fa fa-refresh"></i>
                        <span class="category-name">
                            {{__('Recieved Refund Request')}}
                        </span>
                    </a>
                </li>

                <li class="{{ areActiveRoutesHome(['customer_refund_request'])}}">
                    <a href="{{ route('customer_refund_request') }}">
                        <i class="fa fa-money-coins"></i>
                        <span class="category-name">
                            {{__('Sent Refund Request')}}
                        </span>
                    </a>
                </li>
            @endif

          
            @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                @php
                    $conversation_sent = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                    $conversation_recieved = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                @endphp
                <li>
                    <a href="{{ route('conversations.index') }}" class="{{ areActiveRoutesHome(['conversations.index', 'conversations.show'])}}">
                        <i class="la la-comment"></i>
                        <span class="category-name">
                            {{__('Conversations')}}
                            @if (count($conversation_sent)+count($conversation_recieved) > 0)
                                <span class="ml-2" style="color:green"><strong>({{ count($conversation_sent)+count($conversation_recieved) }})</strong></span>
                            @endif
                        </span>
                    </a>
                </li>
            @endif
            
              
            <li>
                <a href="{{ route('withdraw_requests.index') }}" class="{{ areActiveRoutesHome(['withdraw_requests.index'])}}">
                    <i class="la la-money"></i>
                    <span class="category-name">
                        {{__('Money Withdraw')}}
                    </span>
                </a>
            </li>

            @if ($club_point_addon != null && $club_point_addon->activated == 1)
            <li>
                <a href="{{ route('earnng_point_for_user') }}" class="{{ areActiveRoutesHome(['earnng_point_for_user'])}}">
                    <i class="la la-dollar"></i>
                    <span class="category-name">
                        {{__('Earning Points')}}
                    </span>
                </a>
            </li>
        @endif

        
               
                {{-- @if(auth()->user()->hasRole('vendor'))
                    <li class="header">POS System</li>
                    <li>
                        <a href="#Authentication" class="has-arrow"><i
                                    class="icon-lock"></i><span>POS System</span></a>
                        <ul>
                            <li><a href="{{route('poin-of-sales.index')}}">Create Pos</a></li>
                            <li><a href="{{route('poin-of-sales.activation')}}">Pos Activation</a></li>
                        </ul>
                    </li>
                @endif --}}

                @php
                $support_ticket = DB::table('tickets')
                            ->where('client_viewed', 0)
                            ->where('user_id', Auth::user()->id)
                            ->count();
            @endphp
            <li>
                <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])}} nav-link">
                    <i class="fa fa-support"></i>
                    <span class="menu-title">
                        {{__('Support Ticket')}} @if($support_ticket > 0)<span class="ml-2" style="color:green"><strong>({{ $support_ticket }} {{ __('New') }})</strong></span></span>@endif
                    </span>
                </a>
            </li>

                   
            </ul>
        </nav>
    </div>
</div>
