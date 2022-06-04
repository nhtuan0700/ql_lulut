<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="../../index3.html" class="navbar-brand">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Logo</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
      data-target="#navbarCollapse" aria-controls="navbarCollapse"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="/" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('registration') }}" class="nav-link">Đăng ký ủng hộ</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('history') }}" class="nav-link">Lịch sử ủng hộ</a>
        </li>
      </ul>

    </div>

    <!-- Right navbar links -->
    <ul
      class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto flex align-items-center">
      
      @if (auth()->check() && auth()->user()->role_id === \App\Models\Role::SUPPORTER)
        <li class="nav-item  dropdown user user-menu d-flex align-items-center">
          <a href="#" class="nav-link" data-toggle="dropdown">
            <img src="{{ asset('img/client.png') }}" class="user-image"
              alt="User Image" style="object-fit: cover">
            <span class="hidden-xs"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
              {{ auth()->user()->info->name }}
            </span>

            <div class="dropdown-divider"></div>
            <a href="{{ route('profile.info') }}" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>Trang cá nhân
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
            </a>
          </div>
        </li>
      @else
        <li class="nav-item">
          <a href="{{ route('login') }}">Đăng nhập</a>
        </li>
      @endif
    </ul>
  </div>
</nav>