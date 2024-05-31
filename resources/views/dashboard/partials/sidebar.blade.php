<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            @if (is_null(Auth::user()->profile_picture))
                <img src="{{ asset('images/faces/user-icon.webp') }}">
            @else
                <img src="{{ asset( Auth::user()->profile_picture ) }}">
            @endif
          </div>
          <div class="user-name">
            {{ Auth::user()->name }}
          </div>
          <div class="user-designation">
            {{ Auth::user()->job_title }}
          </div>
        </div>
        <ul class="nav">

          <li class="nav-item {{ Route::currentRouteNamed('admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          {{-- <li class="nav-item {{ Route::currentRouteNamed('') || Route::currentRouteNamed('') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="auth" aria-expanded="{{ Route::currentRouteNamed('') || Route::currentRouteNamed('') ? 'true' : 'false' }}" aria-controls="auth">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Blogs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="{{ Route::currentRouteNamed('') || Route::currentRouteNamed('') ? 'expand' : 'collapse' }}" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('') ? 'active' : '' }}" href="#"> View Blogs </a></li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('') ? 'active' : '' }}" href="#"> Create Blog </a></li>
              </ul>
            </div>
          </li> --}}


          {{-- <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Form elements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/feather-icons.html">
              <i class="icon-help menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="docs/documentation.html">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
        </ul>
      </nav>
