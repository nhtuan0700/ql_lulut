<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Hệ thống quản lý ủng hộ và phân bố huyện Hòa Vang - ĐN</title>
  <link rel="icon" href="{{ asset('iconute.ico') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  @yield('tag_head')
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    {{-- Header --}}
    @include('admin.components.header')

    {{-- Sidebar --}}
    @include('admin.components.sidebar')

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('title')</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      @yield('content')
    </div>

    {{-- Footer --}}
    @include('admin.components.footer')

  </div>
  <div class="box-spinner">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  @if (session('alert-success'))
    <script>
      toastr.success("{!! session('alert-success') !!}")
    </script>
  @endif
  @if (session('alert-fail'))
    <script>
      toastr.error("{!! session('alert-fail') !!}")
    </script>
  @endif

  <script>
    window.onload = function () {
      setTimeout(() => {
        document.querySelector('.box-spinner').classList.add('d-none');
      }, 0);
    }
  </script>
  @yield('script')
  @stack('js')
</body>

</html>
