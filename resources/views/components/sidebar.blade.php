<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <span class="brand-text font-weight-light">DevianArt</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img @if (auth()->user()->photo=='/img/avatar-3.png')
          src="{{asset(auth()->user()->photo)}}" @else src="{{asset('storage/'.auth()->user()->photo)}}"
          @endif  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name ?? 'User'}} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{request()->routeIs('dashboard')?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('category')}}" class="nav-link {{request()->routeIs('category')?'active':''}}">
              <i class="nav-icon fas fa-list"></i>
              <p> Category </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('art')}}" class="nav-link {{request()->routeIs('art')||request()->routeIs('create-art')||request()->routeIs('edit-art')?'active':''}}">
              <i class="nav-icon fab fa-artstation"></i>
              <p> Art </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('artist')}}" class="nav-link {{request()->routeIs('artist')?'active':''}}">
              <i class="nav-icon fas fa-paint-brush"></i>
              <p> Artist </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>z