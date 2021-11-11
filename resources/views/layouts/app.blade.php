<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smartschool') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @guest
        <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">        
    @endguest
    @auth        
        <link href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
        @if (Request::path() == 'users')
            <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
        @endif
    @endauth
</head>

<body>
    @auth  
        <div id="app">   
            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <div class="d-flex justify-content-between">
                            <div class="logo">
                                <a href="/home">Smartschool</a>
                            </div>
                            <div class="toggler">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>
        
                            <li class="sidebar-item  ">
                                <a href="index.html" class='sidebar-link'>
                                    <i class="bi bi-person"></i>
                                    <span>User List</span>
                                </a>
                            </li>
        
                            <li class="sidebar-item  ">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class='sidebar-link'>
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
        
                        </ul>
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                </div>
            </div>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>
    @endauth
        @yield('content')
    @auth
            </div>
        </div>  
        <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>    
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> 
        <script src="{{asset('js/main.js')}}"></script> 
        @if (Request::path() == 'users') 
            <script src="{{asset('vendors/simple-datatables/simple-datatables.js')}}"></script> 
            <script>
                // Simple Datatable
                let usersTable = document.querySelector('#usersTable');
                let dataTable = new simpleDatatables.DataTable(usersTable);
  
                $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function(e){
                    var activeTab = $(e.target).text(); // Get the name of active tab
                    var previousTab = $(e.relatedTarget).text(); // Get the name of previous active tab
                    $(".active-tab span").html(activeTab);
                    $(".previous-tab span").html(previousTab);
                });
            </script>
        @endif
    @endauth
</body>

</html>
