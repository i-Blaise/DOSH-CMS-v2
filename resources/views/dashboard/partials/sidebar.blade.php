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

          <li class="nav-item {{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#homepage" aria-expanded="{{ Route::currentRouteNamed('home-sections.edit') || Route::currentRouteNamed('slideshow.create') ? 'true' : 'false' }}" aria-controls="homepage">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">Homepage</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Route::currentRouteNamed('home-sections.edit') || Route::currentRouteNamed('slideshow.create') ? 'show' : '' }}" id="homepage">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('slideshow.create') ? 'active' : '' }}" href="{{ route('slideshow.create') }}"> Sliders </a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('home-sections.edit') ? 'active' : '' }}" href="{{ route('home-sections.edit', 'insurance') }}"> Home Sections </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item {{ Route::currentRouteNamed('aboutus-sections.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('aboutus-sections.edit', 'whoweare') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">About Us</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pns" aria-expanded="{{ Route::currentRouteNamed('pns-section') || Route::currentRouteNamed('pns-header') ? 'true' : 'false' }}" aria-controls="pns">
              <i class="icon-content-left menu-icon"></i>
              <span class="menu-title">Products & Services</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Route::currentRouteNamed('pns-section') || Route::currentRouteNamed('pns-header') ? 'show' : '' }}" id="pns">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('pns-header') ? 'active' : '' }}" href="{{ route('pns-header') }}"> Header </a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('pns-section') ? 'active' : '' }}" href="{{ route('pns-section', 'insurance') }}"> P&S Sections </a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('pns-video-section') ? 'active' : '' }}" href="{{ route('pns-video-section') }}"> Video Sections </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#hsp" aria-expanded="{{ Route::currentRouteNamed('pns-section') || Route::currentRouteNamed('hsp-header') ? 'true' : 'false' }}" aria-controls="hsp">
              <i class="icon-content-right menu-icon"></i>
              <span class="menu-title">Service Providers</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Route::currentRouteNamed('pns-section') || Route::currentRouteNamed('hsp-header') ? 'show' : '' }}" id="hsp">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('hsp-header') ? 'active' : '' }}" href="{{ route('hsp-header') }}"> Header </a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('hsp-titles') ? 'active' : '' }}" href="{{ route('hsp-titles') }}"> Page Titles </a>
                </li>
                <li class="nav-item"> <a class="nav-link {{ Route::currentRouteNamed('pns-section') ? 'active' : '' }}" href="#"> HSP's </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item {{ Route::currentRouteNamed('contact-page') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contact-page') }}">
              <i class="icon-mail menu-icon"></i>
              <span class="menu-title">Contact Page</span>
            </a>
          </li>

          <li class="nav-item {{ Route::currentRouteNamed('privacy-statement') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('privacy-statement') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Privacy Statement</span>
            </a>
          </li>

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
