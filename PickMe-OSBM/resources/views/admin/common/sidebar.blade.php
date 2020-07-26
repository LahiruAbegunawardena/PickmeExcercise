  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('studentMgt')}}" class="brand-link">
      <img src="{{ asset('admin_lte/dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PickMe </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin_lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          {{-- <a href="{{ route('logout') }}" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a> --}}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{route('studentMgt')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Student Management
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('courseMgt')}}" class="nav-link">
              {{-- <i class="fas fa-users-class"></i> --}}
              <i class="nav-icon fas fa-book"></i>
              <p>
                Course Management
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('paymentMgt')}}" class="nav-link">
              {{-- <i class="fas fa-users-class"></i> --}}
              <i class="nav-icon far fa-credit-card"></i>
              <p>
                Payment Management
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>