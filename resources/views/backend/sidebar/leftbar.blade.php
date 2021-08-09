<?php
$logo=\App\Setting::first();
?>
<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{ route('admin-dashboard') }}">
			<img src="{{ asset('storage/setting/logo/'.$logo->logo) }}"
                                                      alt="zholaa Logo"
                                                      class="" style="width: 70%"></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                    class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                @if( auth()->user()->hasRole('admin') )
                    <li class="header">Main</li>
                    <li class="{{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                        <a href="#myPage" class="has-arrow"><i class="fa fa-tachometer"></i><span>My Page</span></a>
                        <ul>
                            @if( auth()->user()->hasRole('admin') )
                                <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a
                                            href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                                <li class="{{ (request()->is('dashboard/googleanalytics')) ? 'active' : '' }}"><a
                                            href="{{ route('admin-googleanalytics') }}">Google Analytics</a></li>
                            @endif
                            @if(auth()->user()->hasRole('vendor'))
                                <li class="{{ (request()->is('')) ? 'active' : '' }}"><a
                                            href="{{ route('vendor-dashboard') }}">My Dashboard</a></li>
                            @endif
                            @if(auth()->user()->hasPermission('vendor-report'))
                                <li class="{{ (\Route::current()->getName() == 'vendor-report') ? 'active' : '' }}"><a
                                            href="{{ route('vendor-report') }}">Vendor Report</a></li>
                            @endif
                            @if(auth()->user()->hasPermission('customer-report'))
                                <li class="{{ (\Route::current()->getName() == 'customer-report') ? 'active' : '' }}"><a
                                            href="{{ route('customer-report') }}">Customer Report</a></li>
                            @endif
                            {{-- @if(auth()->user()->hasPermission('product-report'))
                                <li class="{{ (\Route::current()->getName() == 'product-report') ? 'active' : '' }}"><a
                                            href="{{ route('product-report') }}">Product Report</a></li>
                            @endif --}}
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Roles and Permission</li>
                    <li class="{{ (request()->segment(1) == 'rolespermission') ? 'active' : '' }}">
                        <a href="#myPage" class="has-arrow"><i
                                    class="icon-home"></i><span>Roles and Permission</span></a>
                        @if(auth()->user()->hasPermission('roles_permission.index'))
                            <ul>
                                <li class="{{ (\Route::current()->getName() == 'roles_permission.index') ? 'active' : '' }}">
                                    <a href="{{ route('roles_permission.index') }}">Permission List</a>
                                </li>
                            </ul>
                       @endif
                        @if(auth()->user()->hasPermission('roles_permission.roles'))
                            <ul>
                                <li class="{{ (\Route::current()->getName() == 'roles_permission.roles') ? 'active' : '' }}">
                                    <a href="{{route('roles_permission.roles')}}">Role List</a></li>
                            </ul>
                        @endif
                    </li>
                @endif


                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Reward Management</li>
                    <li class="{{ (request()->segment(1) == 'club-points/index') ? 'active' : '' }}">
                        <a href="#myPage" class="has-arrow"><i class="icon-home"></i><span>Reward Points </span></a>
                        <ul>
							 <li class="{{ areActiveRoutes(['club_points.configs'])}}">
                                        <a href="{{route('club_points.configs')}}">{{__('Club Point Configurations')}}</a>
                                    </li>
                            <li class="{{ (\Route::current()->getName() == 'club-ponts.index') ? 'active' : '' }}"><a
                                        href="{{ route('club_points.index') }}">{{__('User Points')}}</a>
                            </li>

                                <li class="{{ (\Route::current()->getName() == 'club_points.configs') ? 'active' : '' }}"><a
                                    href="{{ route('set_product_points') }}">{{__('Set Product Point')}}</a>
                    </li>
                        </ul>
                    </li>
                  @endif

                @if(auth()->user()->hasRole('admin'))

                    <li class="{{ Request::is('setting*', 'banners*','activation*','smtp-settings') ? 'active' : '' }}">
                        <a href="#Contact" class="has-arrow"><i
                                    class="icon-anchor"></i><span>System Configuration</span></a>

                        <ul>
                            <li class="{{ (\Route::current()->getName() == 'activation.index') ? 'active' : '' }}">
                                <a
                                        href="{{route('activation.index')}}">{{__('Enable/Disable')}}</a>
                            </li>
                            {{--                            <li class="{{ areActiveRoutes(['payment_method.index'])}}">--}}
                            {{--                                <a--}}
                            {{--                                        href="{{ route('payment_method.index') }}">{{__('Payment method')}}</a>--}}
                            {{--                            </li>--}}

                            <li class="{{ (\Route::current()->getName() == 'smtp_settings.index') ? 'active' : '' }}">
                                <a
                                        href="{{ route('smtp_settings.index') }}">{{__('SMTP Settings')}}</a>
                            </li>
                            <li class="{{ areActiveRoutes(['social_login.index'])}}">
                                <a
                                        href="{{ route('social_login.index') }}">{{__('Social Media Login')}}</a>
                            </li>

                            <li class="   {{ (\Route::current()->getName() == 'currency.index') ? 'active' : '' }}">
                                <a href="{{route('currency.index')}}">{{__('Currency')}}</a>
                            </li>

                            <li class="{{ (\Route::current()->getName() == 'sites.index') ? 'active' : '' }}">
                                <a href="{{ route('sites.index') }}">Site Setting</a></li>
                            <li class="{{ (\Route::current()->getName() == 'banners.index') ? 'active' : '' }}"><a
                                        href="{{ route('banners.index') }}">Banner</a></li>
                            <li class="{{ (\Route::current()->getName() == 'pages.list') ? 'active' : '' }}"><a href="{{route('pages.list')}}">Pages</a></li>

                        </ul>
                    </li>
                    <li class="{{ areActiveRoutes(['home_settings.index', 'home_banners.index', 'sliders.index', 'home_categories.index', 'home_banners.create', 'home_categories.create', 'home_categories.edit', 'sliders.create'])}}">
                        <a class="" href="{{route('home_settings.index')}}"><i class="icon icon-home"></i>{{__('Home')}}
                        </a>
                    </li>

                @endif

                @if (\App\Addon::where('unique_identifier', 'refund_request')->first() != null)
                <li>
                    <a href="#">
                        <i class="fa fa-refresh"></i>
                        <span class="menu-title">{{__('Refund Request')}}</span>
                        <i class="arrow"></i>
                    </a>

                    <!--Submenu-->
                    <ul class="collapse">
                        <li class="{{ areActiveRoutes(['refund_requests_all', 'reason_show'])}}">
                            <a class="nav-link" href="{{route('refund_requests_all')}}">{{__('Refund Requests')}}
                                @if(count(\App\RefundRequest::where('admin_seen',0)->get()) > 0)<span class="pull-right badge badge-info">{{ count(\App\RefundRequest::where('admin_seen',0)->get()) }}</span>@endif
                            </a>
                        </li>
                        <li class="{{ areActiveRoutes(['paid_refund'])}}">
                            <a class="nav-link" href="{{route('paid_refund')}}">{{__('Approved Refund')}}</a>
                        </li>
                        <li class="{{ areActiveRoutes(['refund_time_config'])}}">
                            <a class="nav-link" href="{{route('refund_time_config')}}">{{__('Refund Configuration')}}</a>
                        </li>
                    </ul>
                </li>
            @endif

                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Users Management</li>
                    <li>
                        <a href="#uiIcons" class="has-arrow"><i class="icon-tag"></i><span>User</span></a>
                        <ul>
                            <li><a href="{{ route('users.list') }}">All User</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('users.customer.list') }}">Customer List</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('sellers.index') }}">Vendor List</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('users.admin.list') }}">Admin List</a></li>
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Vendor Management</li>
                    <li>
                        <a href="#uiIcons"
                           class="{{ areActiveRoutes(['sellers.index', 'sellers.create', 'sellers.edit', 'sellers.payment_history','sellers.approved','sellers.profile_modal'])}}"><i
                                    class="icon-tag"></i><span>Sellers</span></a>
                        @php
                            $sellers = \App\Seller::where('verification_status', 0)->where('verification_info', '!=', null)->count();
                            //$withdraw_req = \App\SellerWithdrawRequest::where('viewed', '0')->get();
                        @endphp
                        <ul>
                            <li class="{{ Request::is('seller*') ? 'active' : '' }}">
                                <a href="{{route('sellers.index')}}">{{__('Seller List')}} @if($sellers > 0)
                                        <span class="pull-right badge badge-info">{{ $sellers }}</span> @endif
                                </a>
                            </li>

                            <li class="  {{ (\Route::current()->getName() == 'withdraw_requests_all') ? 'active' : '' }}">
                                <a
                                        href="{{ route('withdraw_requests_all') }}">{{__('Seller Withdraw Requests')}}</a>
                            </li>
                            <li class="  {{ (\Route::current()->getName() == 'sellers.payment_histories') ? 'active' : '' }}">
                                <a
                                        href="{{ route('sellers.payment_histories') }}">{{__('Seller Payments')}}</a>
                            </li>

                            <li class="{{ (\Route::current()->getName() == 'business_settings.vendor_commission') ? 'active' : '' }}">
                                <a
                                        href="{{ route('business_settings.vendor_commission') }}">{{__('Seller Commission')}}</a>
                            </li>
                            {{--                        <li class="{{ areActiveRoutes(['seller_verification_form.index'])}}">--}}
                            {{--                            <a--}}
                            {{--                                    href="{{route('seller_verification_form.index')}}">{{__('Seller Verification Form')}}</a>--}}
                            {{--                        </li>--}}
                            {{--                        @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)--}}
                            {{--                            <li class="{{ areActiveRoutes(['seller_packages.index', 'seller_packages.create', 'seller_packages.edit'])}}">--}}
                            {{--                                <a class="nav-link"--}}
                            {{--                                   href="{{ route('seller_packages.index') }}">{{__('Seller Packages')}}</a>--}}
                            {{--                            </li>--}}
                            {{--                        @endif--}}
                        </ul>
                    </li>
                @endif



                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Customer Package Management</li>
                    <li>


                        <a href="#uiIcons"
                           class="{{ areActiveRoutes(['sellers.index', 'sellers.create', 'sellers.edit', 'sellers.payment_history','sellers.approved','sellers.profile_modal'])}}"><i
                                    class="icon-tag"></i><span>Customer</span></a>
                        <ul>
                            <li class="{{ areActiveRoutes(['customers.index'])}}">
                                <a
                                        href="{{ route('customers.index') }}">{{__('Customer list')}}</a>
                            </li>
                            <li class="{{ areActiveRoutes(['customer_packages.index', 'customer_packages.create', 'customer_packages.edit'])}}">
                                <a
                                        href="{{ route('customer_packages.index') }}">{{__('Classified Packages')}}</a>
                            </li>
                        </ul>
                    </li>

                @endif

                @if(auth()->user()->hasRole('admin'))
                    <li class="header">Sales</li>
                    <li class="{{Request::is('sale*') ? 'active' : ''}}">
                        <a href="{{url('sale')}}" class="has-arrow"><i
                                    class="icon-lock"></i><span>Total Sales</span></a>
                    </li>
                @endif

@if(Auth::user()->hasRole('admin'))
                <li class="header">E-Commerce Management</li>
                <li class="{{ Request::is('e-commerce*') ? 'active' : '' }}">
                    <a href="#Contact" class="has-arrow"><i
                                class="icon-book-open"></i><span>Setup E-Commerce</span></a>
                    <ul>
                        <li class="{{ areActiveRoutes(['attributes.index','attributes.create','attributes.edit'])}}">
                            <a href="{{route('attributes.index')}}">{{__('Attribute')}}</a>
                        </li>


                        <li class="{{ (\Route::current()->getName() == 'coupons.list') ? 'active' : '' }}">
                            <a href="{{ route('coupons.list') }}">Coupon List</a></li>

                        <li class="{{Route::current()->getName() == 'shippings.list' ? 'active' : ''}}">
                            <a href="{{route('shipping_configuration.index')}}">Shipping Configuration</a>
                        </li>

                        <li class="{{Route::current()->getName() == 'shippings.list' ? 'active' : ''}}">
                            <a href="{{route('countries.index')}}">Shipping Countries</a>
                        </li>

                    </ul>
                </li>


                <li class="{{ Request::is('flash_deal*') ? 'active' : '' }}">
                    <a href="{{ route('flash_deals.index')}}"><i class="fa fa-flash"></i><span>Flash Deal</span></a>
                </li>

@endif
                <li class="header">Management</li>
                <li class="{{ Request::is('product*') ? 'active' : '' }}">
                    <a href="#Contact" class="has-arrow"><i class="icon-book-open"></i><span>Product</span></a>
                    <ul>
                        @if(auth()->user()->hasRole('admin'))


                        <li class="{{ (\Route::current()->getName() == 'products.admin') ? 'active' : '' }}"><a
                                    href="{{ route('products.admin') }}">In House Products</a></li>

                        <li class="{{ (\Route::current()->getName() == 'products.seller') ? 'active' : '' }}"><a
                                    href="{{ route('products.seller') }}">Seller Products</a></li>
                                    @else
                                    <li class="{{ (\Route::current()->getName() == 'products.seller') ? 'active' : '' }}"><a
                                        href="{{ route('seller.products')}}">All Products</a></li>
                                        @endif
                        <li class="{{ (\Route::current()->getName() == 'brands.list') ? 'active' : '' }}"><a
                                    href="{{route('brands.index')}}">Brands</a>
                        @if(auth()->user()->hasPermission('products.comments'))
                            <li class="{{ (\Route::current()->getName() == 'reviews.list') ? 'active' : '' }}">
                                <a href="{{route('products.comments') }}">Comment and review </a></li>
                        @endif

                    </ul>
                </li>


                @if(auth()->user()->hasRole('admin'))
                    @php
                        $orders = DB::table('orders')
                                    ->orderBy('code', 'desc')
                                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                    ->where('order_details.seller_id', \App\User::where('user_type', 'admin')->first())    
                                    ->where('orders.viewed', 0)
                                    ->select('orders.id')
                                    ->distinct()
                                    ->count();
                    @endphp

                    <li class="header">InHouse Orders</li>
                    <li class="{{Request::is('order*') ? 'active' : ''}}">
                        <a href="{{ route('orders.admin') }}" class="has-arrow"><i
                                    class="icon-lock"></i><span>Orders @if($orders > 0)<span
                                        class="pull-right badge badge-info">{{ $orders }}</span>@endif</span>
                        </a>
                    </li>
                @endif

                <li class="header">Category Management</li>
                <li class="{{ Request::is('categories*') ? 'active' : '' }}">
                    <a href="#Contact" class="has-arrow"><i class="icon-book-open"></i><span>Categories</span></a>
                    <ul>
                        <li class="{{(\Route::current()->getName() == 'categories.index') ? 'active' : '' }}"><a
                                    href="{{ route('categories.index') }}"><span>Category</span></a></li>
                        <li class="{{ areActiveRoutes(['subcategories.index', 'subcategories.create', 'subcategories.edit'])}}">
                            <a class=""
                               href="{{route('subcategories.index')}}">{{__('Sub-Category')}}
                            </a>
                        </li>
                        <li class="{{ areActiveRoutes(['subsubcategories.index', 'subsubcategories.create', 'subsubcategories.edit'])}}">
                            <a class=""
                               href="{{route('subsubcategories.index')}}">{{__('SubSub-Category')}}</a>
                        </li>
                    </ul>
                </li>

                <li class="header">Reports</li>
                <li class="{{Request::is('report*') ? 'active' : ''}}">
                    <a href="#Authentication" class="has-arrow"><i
                                class="icon-book-open"></i><span>Reports</span></a>
                    <ul>
                        <li class="">
                            <a class="nav-link"
                               href="{{ route('reports.in_house_sale_report') }}">{{__('In House Sale Report')}}</a>
                        </li>
                        @if(auth()->user()->hasPermission('reports.stock'))
                            <li class="{{(\Route::current()->getName() == 'reports.stock') ? 'active' : '' }}">
                                <a
                                        href="{{route('reports.stock')}}">Stock Report</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('reports.seller'))
                            <li class="{{(\Route::current()->getName() == 'reports.seller') ? 'active' : '' }}">
                                <a
                                        href="{{route('reports.seller')}}">Seller Report</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('reports.seller.based'))
                            <li class="{{(\Route::current()->getName() == 'reports.seller.based') ? 'active' : '' }}">
                                <a href="{{route('reports.seller.based')}}">Seller Based Selling
                                    Report</a></li>
                        @endif

                        @if(auth()->user()->hasPermission('reports.wishlist'))
                            <li class="{{(\Route::current()->getName() == 'reports.wishlist') ? 'active' : '' }}">
                                <a
                                        href="{{route('reports.wishlist')}}">WishList Report</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('reports.commission'))
                            <li class="{{(\Route::current()->getName() == 'reports.commission') ? 'active' : '' }}">
                                <a
                                        href="{{route('reports.commission')}}">Commission Report</a></li>
                        @endif
                    </ul>
                </li>
                <li class="header">Dispute</li>
                <li class="{{Request::is('dispute*') ? 'active' : ''}}">
                    <a href="{{ route('disputes') }}" class="has-arrow"><i
                                class="icon-lock"></i><span>Dispute</span></a>
                </li>
                               @if(auth()->user()->isAbleTo('affiliate.*'))
                <li class="header">Affiliate System</li>
                <li>
                    <a href="#Authentication" class="has-arrow"><i
                                class="icon-lock"></i><span>Affiliate System</span></a>
                    <ul>
                        <li><a href="{{ route('affiliate.configs') }}">Affiliate Configuration</a></li>
                        <li><a href="{{ route('affiliate.index') }}">Affiliate Options</a></li>
                       {{-- <li><a href="{{ route('affiliate.users') }}">Affiliate Users</a></li>--}}
                        {{-- <li><a href="{{ route('refferals.users') }}">Referral Users</a></li> --}}
                    </ul>
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
                                    ->where('viewed', 0)
                                    ->select('id')
                                    ->count();
                    @endphp
                    <li class="{{ areActiveRoutes(['support_ticket.admin_index', 'support_ticket.admin_show'])}}">
                        <a class="nav-link" href="{{ route('support_ticket.admin_index') }}">
                            <i class="fa fa-support"></i>
                            <span class="menu-title">{{__('Support Ticket')}} @if($support_ticket > 0)<span
                                        class="pull-right badge badge-info">{{ $support_ticket }}</span>@endif</span>
                        </a>
                    </li>



            </ul>
        </nav>
    </div>
</div>
