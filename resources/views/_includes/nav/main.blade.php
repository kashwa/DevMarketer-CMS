{{-- header --}}
<nav class="navbar has-shadow">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item is-paddingless m-r-15" href="{{route('home')}}">
                <img src="{{ asset('images/devmarketer-logo.png') }}" alt="DevMarketer"/>
            </a>

            @if (Request::Segment(1) == 'manage')
                <a class="navbar-item" id="admin-slideout-button">
                    <span class="icon is-hidden-desktop"><i class="fa fa-arrow-circle-o-right"></i></span>
                </a>
            @endif

            <button class="button navbar-burger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a href="#" class="navbar-item is-tab">Learn</a>
                    <a href="#" class="navbar-item is-tab">Discuss</a>
                    <a href="#" class="navbar-item is-tab">Share</a>
                </div>
            </div>
        </div>
        
        <div class="navbar-end">
            @guest
                <a href="{{route('login')}}" class="navbar-item is-tab">LogIn</a>
                <a href="{{route('register')}}" class="navbar-item is-tab">Join the community</a>
            @else
                <button class="dropdown navbar-item has-dropdown is-hoverable">
                    Hey {{Auth::user()->name}} <span class="icon"><i class="fa fa-caret-down"></i></span>

                    <ul class="dropdown-menu">

                        <li>
                            <a href="{{route('users.show', Auth::user()->id)}}">
                            <span class="icon"><i class="fa fa-w m-r-10 fa-user-circle"></i></span>
                            Profile</a>
                        </li>

                        <li>
                            <a href="#">
                            <span class="icon"><i class="fa fa-w m-r-10 fa-bell"></i></span>
                            Notifications</a>
                        </li>

                        <li>
                            <a href=" {{route('manage.dashboard')}} ">
                            <span class="icon"><i class="fa fa-w m-r-10 fa-cog"></i></span>
                            Manage</a>
                        </li>

                        <li class="separator"></li> {{-- to separate items with line --}}
                        
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="icon"><i class="fa fa-w m-r-10 fa-sign-out"></i></span>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </button>
            @endguest
        </div>
    </div>
</nav>