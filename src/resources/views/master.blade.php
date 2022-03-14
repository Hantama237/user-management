<!doctype html>
<html lang="id" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jaqueour">
    <meta name="generator" content="Hugo 0.88.1">
    <title>User Management</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">

    

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap-grid.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap-utilities.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap-reboot.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @yield("head")

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    
    
    <!-- Custom styles for this template -->
    <link href="{{asset('/mycss/cover.css')}}" rel="stylesheet">
</head>
<body style="min-height: 100%" class="d-flex  text-center text-white bg-dark">
    <div style="min-width: 43em; max-width:60em;" class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
            
            <h3 class="float-md-start mb-0">UsMan 
              @if(Session::get("id"))
              <small>as @if(Session::get('type')=="user") User @else Admin @endif</small>
              @endif
            </h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
              @if(Session::get('id'))
                @if(Session::get('type')=="user")
                <a class="nav-link @if(Session::get('current_page')=='home') active @endif" aria-current="page" href="/">Home</a>
                <a class="nav-link @if(Session::get('current_page')=='profile') active @endif" href="/profile">My Profile</a>
                <a class="nav-link " href="/logout">Logout</a>
                @else 
                <a class="nav-link @if(Session::get('current_page')=='home') active @endif" aria-current="page" href="/admin">Home</a>
                <a class="nav-link @if(Session::get('current_page')=='profile') active @endif" href="/admin/profile">My Profile</a>
                <a class="nav-link " href="/admin/logout">Logout</a>
                @endif
              @else 
                <a class="nav-link @if(Session::get('current_page')=='login') active @endif" aria-current="page" href="/login">Login</a>
                <a class="nav-link @if(Session::get('current_page')=='loginadmin') active @endif" aria-current="page" href="/admin/login">Login Admin</a>
              @endif
            </nav>
            </div>
        </header>
        @yield('content')
        <footer class="mt-auto text-white-50">
            <p>User Management website <a style="text-decoration: none;" href="/" class="text-white">UsMan</a>, by <a style="text-decoration: none;" href="https://www.instagram.com/handryan_pratama" class="text-white">@hantama</a>.</p>
        </footer>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield("script")
</body>
</html>
