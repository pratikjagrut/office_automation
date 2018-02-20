<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!--jquery-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <!--jquery-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        @if (auth()->user()->user_type == 'super admin')
                                @include('sidebar.superAdmin')
                            @else
                                @switch(auth()->user()->department)
                                    @case('cc')
                                        @include('sidebar.cc')
                                        @break
                                    
                                    @case('hr')
                                        @include('sidebar.hr')
                                        @break

                                    @case('inventory')
                                        @include('sidebar.inventory')
                                        @break

                                    @case('noc')
                                        @include('sidebar.noc')
                                        @break

                                    @case('sales')
                                        @include('sidebar.sales')
                                        @break
                                    
                                    @case('voip')
                                        @include('sidebar.voip')
                                        @break                
                                    @default
                                            Default case...
                                @endswitch
                                
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @if (Auth::user()->user_type == 'super admin')
                                       <li>
                                           <a href="{{ url('/dashboard') }}">Dashboard</a>
                                       </li> 
                                    @endif
                                    <li>
                                        <a href="{{ url('/profile') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="/profile/{{auth()->user()->id}}/edit">Update Profile</a>
                                    </li>
                                    @if (Auth::user()->user_type == 'admin')
                                        <li>
                                            <a href="{{ url('/adminRights') }}">
                                                Admin Rights
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}">
                                                Add new user
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>    
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('inc.messages')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        function toggleSidebar(ref) {
          ref.classList.toggle('active');
          document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
