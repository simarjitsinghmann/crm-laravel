<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="_token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto text-center">
                    @role('superadmin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tickets.index')}}">Tickets</a>
                        </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
                        </li>
                    @endrole
                    @role('tech')
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tickets.index')}}">Tickets</a>
                    </li>
                    @endrole
                    @role('sales')
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tickets.create')}}">Create New Ticket</a>
                        </li>
                    @endrole
                    @role('customer')
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
                        </li>
                    @endrole
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <script>
    $(document).ready(function(){
        $('.search').on('click',function(){
            var value=$(this).siblings('#search').val();
            var field=$(this).siblings('input[name=search_field]:checked').val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search/find')}}',
                data:{'search':value,'field':field},
                success:function(data)
                {
                    $('tbody').html(data);
                }
            });
        });
    })

    </script>

    <script>

     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    </script>
</body>
</html>
