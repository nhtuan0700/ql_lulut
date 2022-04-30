<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">

  <!-- Sidebar -->
  <div class="sidebar mt-0">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 pt-3 mb-3">
      <div class="image d-block">
        <img src="{{ asset('img/admin.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        {{-- <a href="#" class="d-block">{{ Auth::user()->role->name }}</a> --}}
        <h5 class="text-light mt-1">{{ auth()->user()->info->name }}</h5>
        <div class="text-light mt-1"><b>Vai trò: </b>{{ auth()->user()->role->name }}</div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column list-menu" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.index') }}" class="nav-link" data-link="home">
            <p>
              Trang chủ
            </p>
          </a>
        </li>
        @can('user.manage')
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link" data-link="user">
              <p>
                Quản lý người dùng
              </p>
            </a>
          </li>
        @endcan
        @can('goods.manage')
          <li class="nav-item">
            <a href="{{ route('admin.goods.index') }}" class="nav-link" data-link="hang-cuu-tro">
              <p>
                Quản lý hàng cứu trợ
              </p>
            </a>
          </li>
        @endcan
        @can('post.manage')
          <li class="nav-item">
            <a href="{{ route('admin.post.index') }}" class="nav-link" data-link="bai-viet">
              <p>
                Quản lý bài viết
              </p>
            </a>
          </li>
        @endcan
      </ul>
    </nav>
  </div>
</aside>

@push('js')
  {{-- Active Link --}}
  <script src="{{ asset('js/active-link.js') }}"></script>
  <script>
    $(function() {
      var options = {
        
      };
      ActiveLink('.list-menu', options);
    })

  </script>
@endpush
