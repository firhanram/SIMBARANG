<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Left Nav --}}
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    {{-- Right Nav --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <i class="fas fa-user-circle"></i><span class="ml-1">{{session('name')}} |  {{session('role')}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt text-primary"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
  </nav>