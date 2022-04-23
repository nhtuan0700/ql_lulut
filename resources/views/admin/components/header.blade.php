<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav d-flex align-items-center">
    <li class="nav-item">
      <a class="nav-link" id="pushmenu" data-widget="pushmenu" href="#" role="button"><i
          class="fas fa-bars"></i></a>
    </li>
    <li>
      <a href="#" class="d-flex align-items-center pl-2 pr-2">
        <img src="{{ asset('admin/img/logo.png') }}" alt="" width="38px">
        <p class="m-0 ml-2">HỆ THỐNG QUẢN LÝ ỦNG HỘ VÀ PHÂN BỐ<br>
          <span style="color: #f28b43">Huyện Hòa Vang - ĐN</span>
        </p>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    {{-- @include('components.notification') --}}
    <li class="nav-item dropdown user user-menu d-flex align-items-center">
      <a href="#" class="nav-link" data-toggle="dropdown">
        <img src="{{ asset('admin/img/user.png') }}" class="user-image" alt="User Image">
        <span class="hidden-xs"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
          {{ auth()->user()->info->name }}
        </span>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-user mr-2"></i>Trang cá nhân
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.logout') }}" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
        </a>
      </div>
    </li>
  </ul>
</nav>
