  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('admin/assets/img/logo-image.svg') }}" alt="logo">
        </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
              <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0 text-capitalize" href="#"
                      data-bs-toggle="dropdown">
                      <img src="{{ asset('admin/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6 class="text-capitalize">{{ auth()->user()->name }}</h6>
                          <span>{{ auth()->user()->role }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </header>
