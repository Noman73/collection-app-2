<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('/home')}}" class="brand-link">
      <img src="{{asset('storage/adminlte/dist/img/logo.jpg')}}" alt="অর্ঘ্য প্রস্ব্যস্তি" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">অর্ঘ্য প্রস্ব্যস্তি</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{asset('storage/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> --}}
          <i class="fas fa-circle mt-2 text-success"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{URL::to('/home')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                ড্যাশবোর্ড
              </p>
            </a>
          </li>
          @role('admin')
          <li class="nav-item">
            <a href="{{route('submission.index')}}" class="nav-link">
              <i class="nav-icon fas fa-donate"></i>
              <p>
                কালেক্টর জমা
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/collector-data')}}" class="nav-link">
              <i class="nav-icon fas fa-info"></i>
              <p>
                কালেক্টর তথ্য
              </p>
            </a>
          </li>
          @endrole
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                আদায়
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('collection.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>আদায়</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('donor.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                দাতা
              </p>
            </a>
          </li>
          @role('admin')
          <li class="nav-item">
            <a href="{{route('rittiki.index')}}" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                ঋত্বিকী
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('rittiki-pay.index')}}" class="nav-link">
              <i class="nav-icon fas fa-donate"></i>
              <p>
                ঋত্বিকী পরিশোধ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               ব্যবহারকারী
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/scrolling-text')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               স্ক্রলিং টেক্সট
              </p>
            </a>
          </li>
          @endrole
          <li class="nav-item">
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                সাইন আউট
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>