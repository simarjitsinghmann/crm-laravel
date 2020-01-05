<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ticket Support</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                   <strong>Ticket Support</strong>
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('filter')}}">Filter</a>
                        </li>
                    @endrole
                    @role('tech')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tickets.index')}}">Tickets</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
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
                        <a class="nav-link" href="{{route('tickets.index')}}">Tickets</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('search')}}">Search</a>
                        </li>
                    @endrole
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
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
                @auth
            <h2 class="text-center">
            @role('superadmin')
            Super Admin Dashboard
            @endrole
            @role('sales')
            Sales Dashboard
            @endrole
            @role('tech')
            Tech Dashboard
            @endrole
            @role('customer')
            Customer Support Dashboard
            @endrole
            </h2>
            <hr>
            @endauth
                @yield('content')
            </div>
        </main>
    </div>
  
    
    <style>
      .user-table.table,.details{display:none;}
    .modals_pop {
        position: fixed;
        right:25px;
        bottom: 5px;
        max-width: 300px;
        padding: 15px 30px 10px 20px;
        background-color: #fff;
        border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px; -ms-border-radius: 6px; -o-border-radius: 6px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.06); -webkit-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.06); -moz-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.06); -ms-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.06); -o-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.06);
    }
    .modals_pop p {
    font-size: 14px;
    line-height: 14px;
    margin-bottom: 5px;
    }
    .modals_pop a{
        text-decoration:none !important;
        color:#000 !important;
    }
    .modals_pop a:hover{
        text-decoration:none !important;
        color:#000 !important;
    }
    .modals_pop .closebtn {
        position: absolute;
        right: 10px;
        top: 10px;
    }
    .modals_pop:nth-of-type(2) {
        bottom: 50px;
    }
    .modals_pop:nth-of-type(3) {
        bottom:150px;
    }
    .modals_pop:nth-of-type(4) {
        bottom: 250px;
    }
    .modals_pop:nth-of-type(5) {
        bottom: 350px;
    }
    .modals_pop:nth-of-type(6) {
        bottom: 450px;
    }
    </style>
    @yield('scripts')
    
    <script>


    $(document).ready(function(){
        $('.search').on('click',function(){
            var value=$(this).siblings('#search').val();
            var field=$(this).siblings('input[name=search_field]:checked').val();
            if(value==''){
                alert('Please Enter Email or Contact Number ');
            }
            else{
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('search/find')}}',
                    data:{'search':value,'field':field},
                    success:function(data)
                    {
                        $('tbody').html(data);
                    }
                });
            }
        });
    });
    $(document).ready(function(){
            $('select').change(function () {
            var optionSelected = $(this).find("option:selected");
            var valueSelected  = optionSelected.val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('user/find')}}',
                data:{'role':valueSelected},
                success:function(data)
                { 
                    if(data=='no'){

                    }
                    else{
                    $('.users').html(data);
                    }
                }
            });
        });

        $('.search-user').on('click',function(){
            var role=$('.roles option:selected').val();
            var user=$('.users option:selected').val();
            var date=$('.datepicker').val();
            var res = date.split("-");
            var month=res[0];
            var year=res[1];
            $.ajax({
                type : 'get',
                url : '{{URL::to('filter/list')}}',
                data:{'role':role,'id':user,'month':month,'year':year},
                success:function(data)
                { 
                    if(data=='no'){
                        alert('No Result Found');
                    }
                    else{
                    $('.details').html(data['solved']);
                    $('.user-table tbody').html(data['output']);
                    $('.user-table').css('display','table');
                    $('.details').show();
                    }
                }
            });
        });    
    });

    </script>
    @role('tech|customer')
    <script>
        $(document).ready(function(){
            $(document).on('click','.closebtn',function(){
                $(this).parent('.modals_pop').remove();
            });
            @role('tech')
            var role='tech';
            @endrole
            @role('customer')
            var role='customer';
            @endrole
            var value={{Auth::id()}};
            var count={{Auth::user()->ticket_count}};
            setInterval(function() {
            console.log(role);
                $.ajax({
                type : 'get',
                url : '{{URL::to('ticket/latest')}}',
                data:{'search':value,'count':count,'role':role},
                success:function(data)
                { 
                   if(data=='no'){
                   }
                   else{
                    $('body').append(data['output']);
                    count=data['count'];
                   }
                }
            });
            }, 2000);
        });        
    </script>
    @endrole
    
    <script>

     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    </script>
</body>
</html>
