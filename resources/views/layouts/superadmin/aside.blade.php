<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center mt-3">
        <a class="" href="javascript:void(0)">
          <img src="{{ asset('/img/logo.png') }}" class="" alt="Logo" style="width: 96px !important; height: 96px !important;">
        </a>
      </div>
      <div class="navbar-inner mt-3">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/home') }}">
                <i class="fas fa-th-large"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Academic</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin/academic/base-class') }}">
                <i class="fas fa-school"></i>
                <span class="nav-link-text">Class Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin/system-access/administrator') }}">
                <i class="fas fa-user-graduate"></i>
                <span class="nav-link-text">Student Management</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin/system-access/administrator') }}">
                <i class="fas fa-info-circle"></i>
                <span class="nav-link-text">Info Management</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">System Access</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin/system-access/administrator') }}">
                <i class="fas fa-user-shield"></i>
                <span class="nav-link-text">Administrator</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/superadmin/system-access/administrator') }}">
                <i class="fas fa-user-lock"></i>
                <span class="nav-link-text">User</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
