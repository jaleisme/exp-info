<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A simple and futuristic multi-role authentication system.">
        <meta name="author" content="Jale">
        <title>{{ env('APP_NAME') }}</title>
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('/templates/img/brand/favicon.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('/templates/vendor/nucleo/css/nucleo.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('/templates/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{ asset('/templates/css/argon.css?v=1.2.0') }}" type="text/css">
        @yield('custom-style')
      </head>

<body>
  <!-- Sidenav -->
  @if(Auth::user()->role == 1)
  @include('layouts.superadmin.aside')
  @elseif(Auth::user()->role == 2)
  @include('layouts.admin.aside')
  @elseif(Auth::user()->role == 3)
  @include('layouts.user.aside')
  @endif
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                    <div class="media-body  mr-2  d-none d-lg-block">
                        <span class="mb-0 text-sm font-weight-bold">{{ Auth::user()->name }}</span>
                      </div>
                    <span class="avatar rounded-circle">
                      <img src="{{ asset('/templates/img/theme/team-4.jpg') }}" class="avatar rounded-circle">
                    </span>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ url('/profile/'.Auth::user()->id) }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out-alt"></i>
                  <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-12">
                    {{-- <h6 class="h2 text-white d-inline-block mb-0">{{ Route::currentRouteName() }}</h6> --}}
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark bg-white">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i></a></li>
                        @php
                            $url = explode('/', Request::url());
                            $bc = [];
                            $fix = [];
                            foreach ($url as $key => $value) {
                            if (strpos($value, 'http') !== false || strpos($value, '127') !== false ) {

                            } else {
                                $bc[] = $value;
                            }
                            }
                            foreach ($bc as $key => $v) {
                                if($v == ""){

                                } else {
                                    $fix[] = $v;
                                }
                            }
                            $last = count($fix) - 1;
                        @endphp
                        @foreach ($fix as $k => $item)
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route($item) }}" class="@if($k == $last) text-muted @endif">
                                {{ $item }}
                            </a>
                    </li>
                        @endforeach
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @yield('content')
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('/templates/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/templates/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('/templates/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('/templates/js/argon.js?v=1.2.0') }}"></script>
  @yield('custom-script')
</body>

</html>
