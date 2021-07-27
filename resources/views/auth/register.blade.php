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
      </head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('') }}" alt="Logo">
        {{-- <img src="{{ asset('/templates/img/brand/white.png') }}" alt="Logo"> --}}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ url('/') }}">
                <img src="{{ asset('') }}" alt="Logo">
                {{-- <img src="{{ asset('/templates/img/brand/blue.png') }}" alt="Logo"> --}}
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          {{-- <li class="nav-item">
            <a href="login.html" class="nav-link">
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="register.html" class="nav-link">
              <span class="nav-link-inner--text">Register</span>
            </a>
          </li> --}}
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                  <span class="nav-link-inner--text">Login</span>
                </a>
              </li>
              <li class="nav-item active">
                <a href="{{ route('register') }}" class="nav-link">
                  <span class="nav-link-inner--text">Register</span>
                </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Create an account</h1>
              <p class="text-lead text-white">Create a new account to access a simple and futuristic multi-role authentication system.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Sign up with credentials</small>
              </div>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control px-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="E.g. John Doe">
                  </div>
                  @error('name')
                      <small class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </small>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control px-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E.g. johndoe@mailer.co">
                  </div>
                  @error('email')
                      <small class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </small>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                  </div>
                  @error('password')
                      <small class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </small>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control px-3" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="text-muted font-italic"><small>password strength: <span id="password-status" class="font-weight-700"></span></small></div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Create account</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2021 <a href="https://jaleisme.github.io" class="font-weight-bold ml-1" target="_blank">Jaleisme</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://jaleisme.github.io" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Template</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('/templates/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/templates/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/templates/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('/templates/js/argon.js?v=1.2.0') }}"></script>
  {{-- CUSTOM JS --}}
  <script>
      let status = $('#password-status')
      let input = $('#password')
      let length = 0
      $('document').ready(function(){
        status.addClass('text-danger')
        status.text('too weak')
      })
      input.keydown(function(){
          length = input.val().length;
          if(length == 0){
            status.removeClass('text-success')
            status.removeClass('text-warning')
            console.log('too weak '+length);
            status.addClass('text-danger')
            status.text('too weak')
          }
          if(length > 0 || length <= 6){
            status.removeClass('text-success')
            status.removeClass('text-danger')
            console.log('weak '+length);

            status.addClass('text-warning')
            status.text('weak')
          }
          if(length > 6){
            status.removeClass('text-warning')
            status.removeClass('text-danger')
            console.log('strong '+length);

            status.addClass('text-success')
            status.text('strong')
          }
      })
  </script>
</body>

</html>
