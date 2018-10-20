<!doctype html>

<html lang="en">

  <head>
    
    <title>PSI</title>
    
    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, 
                                  initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">

    {{-- DataTable Css --}}
    <link rel="stylesheet" type="text/css"
      href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
      
    <link rel="stylesheet" href="/css/app.css">
    
    <link rel="stylesheet" href="/css/psi-cms.css">
    
    {{-- <link href="/css/datepicker.css" rel="stylesheet"> --}}

    <script src="/js/app.js"></script>
        
    {{-- DataTable Js--}}
    <script type="text/javascript" charset="utf8"
      src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
          
    <script src="/js/psi-cms.js" defer></script>
    
    {{-- <script src="/js/datepicker.js"></script> --}}
        
    @yield('more')
      
  </head>
  
  <body class="app header-fixed sidebar-lg-show sidebar-fixed">
    
    <header class="app-header navbar">
      
      <!-- Header content here -->
            
      <a class="navbar-brand" href="{{ url('/admin') }}">
        <span class="logo-text">PSI</span>
      </a>
      
      <button class="d-none d-lg-inline navbar-toggler sidebar-toggler mr-auto" 
        type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <button class="d-lg-none navbar-toggler sidebar-toggler mr-auto" 
        type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <ul class="nav navbar-nav d-none d-lg-flex">
        
        <li class="nav-item px-3">
          
          <div class="dropdown">
            <a href="#" 
               class="nav-link {{ isActiveRoute('change_password') }} dropdown-toggle" 
               data-toggle="dropdown">
              <i class="nav-icon cui-user"></i> {{ fullName(Auth::user()->first_name, Auth::user()->last_name) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}"
                method="POST" style="display: none;">{{ csrf_field() }}</form>
              <a class="dropdown-item" href="{{ route('change_password') }}">
                Change password
              </a>
            </div>
          </div>
          
        </li>
      </ul>
              
    </header>
    
    <div class="app-body">
      
      <div class="sidebar">
        <!-- Sidebar content here -->
        @include('cms.layouts.sidebar')
      </div>
      
      <main class="main" id="vue-container">
        
        <!-- Main content here -->
        
        @yield('breadcrumb')
        
        <div class="container mt-3 mb-3">
          
          @if(!isActiveRoute('change_password'))
            <div class="row mb-1">
              <div class="col-12">
                @include('cms.alerts.alerts')
              </div>
            </div>
          @endif
          
          @yield('content')
          
        </div>
        
      </main>
      
    </div>
    
    <footer class="app-footer d-flex justify-content-center">
      
      <!-- Footer content here -->
      All Rights Reserved &copy; PSI TZ IT-SUPPORT TEAM {{date('Y')}}
      
    </footer>
    
  </body>
  
</html>