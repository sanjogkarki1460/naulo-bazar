<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="{{ route('admin-dashboard') }}"><img src="{{ asset('backend/assets/images/logo.png') }}" alt="zholaa Logo"
                        class="" style="width: 90%"></a>
                <button type="button" class="btn-toggle-offcanvas"><i
                        class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <ul class="nav navbar-nav">
                @if(isset($contacts))
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="icon-envelope"></i>
                        <span class="notification-dot bg-green">{{$contacts->count()}}</span>
                    </a>
                    <ul class="dropdown-menu right_chat email vivify fadeIn">
                        <li class="header green">You have {{$contacts->count()}} New eMail</li>
                        <li>

                            @foreach($contacts as $key => $contact)
                            <a href="{{route('contact.list')}}">
                                <div class="media">
                                    <div class="avtar-pic w35 bg-red"><span>FC</span></div>
                                    <div class="media-body">
                                    <span class="name">{{$contact->name}} <small class="float-right text-muted">{{$contact->created_at->diffForHumans()}}</small></span>
                                        <span class="message">{{Str::limit($contact->message,20)}}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </li>
                    </ul>
                </li>
                @endif
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="notification-dot bg-azura"> {{auth()->user()->notifications->count()}}</span>
                    </a>
                    <ul class="dropdown-menu feeds_widget vivify fadeIn">
                        <li class="header blue">You have {{auth()->user()->notifications->count()}} New Notifications</li>
                        @if(auth()->user()->notifications)
                        @foreach (auth()->user()->notifications->take(5) as $notification) 
                            {{-- echo $notification->type; --}}
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="feeds-left bg-red"><i class="fa fa-check"></i></div>
                                    <div class="feeds-body">
                                        <h4 class="title text-danger">Order<small
                                                class="float-right text-muted">{{$notification->created_at}}</small></h4>
                                        <small>Order Placed</small>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                     @endif
                    </ul>
                </li>
            </ul>
        </div>

        <div class="navbar-right">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ auth()->user()->name }}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="{{ route('users.profile') }}"><i class="icon-user"></i>My Profile</a></li>
                       
                       
                        <li class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>                
            </div>  
        </div>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>