<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng ký</title>
  <link rel="icon" href="{{ asset('iconute.ico') }}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet"
    href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet"
    href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="/" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body login-card-body">
        <p class="login-box-msg">Đăng ký tài khoản với tư cách người ủng hộ</p>

        <form action="#" method="post" id="form">
          @csrf
          <div class="input-group mb-3 form-group">
            <input type="text"
              class="form-control @error('name') is-invalid @enderror"
              placeholder="Họ tên" name="name" value="{{ old('name') }}"
              rules="required">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-group mb-3 form-group">
            <input type="text"
              class="form-control @error('phone_number') is-invalid @enderror"
              placeholder="Số điện thoại" name="phone_number"
              value="{{ old('phone_number') }}" maxlength="10" rules="required|phone">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <select class="form-control" id="type" name="type">
              <option value="1">Đại diện cá nhân</option>
              <option value="2">Đại diện công ty/tổ chức</option>
            </select>
          </div>
          {{-- Cá nhân --}}
          <div class="" id="personal">
            <div class="mb-3 form-group">
              <input type="text"
                class="form-control @error('address') is-invalid @enderror"
                placeholder="Địa chỉ" name="address"
                value="{{ old('address') }}">
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          {{-- Tổ chức --}}
          <div class="" id="organize">
            <div class="mb-3 form-group">
              <input type="text"
                class="form-control @error('company_name') is-invalid @enderror"
                placeholder="Tên công ty/tổ chức" name="company_name"
                value="{{ old('company_name') }}">
              @error('company_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3 form-group">
              <input type="text"
                class="form-control @error('company_address') is-invalid @enderror"
                placeholder="Địa chỉ công ty/tổ chức" name="company_address"
                value="{{ old('company_address') }}">
              @error('company_address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          
          <div class="input-group mb-3 form-group">
            <input type="text"
              class="form-control @error('email') is-invalid @enderror"
              placeholder="Email" name="email" value="{{ old('email') }}"
              rules="required|email">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-group mb-3 form-group">
            <input type="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="Mật khẩu" name="password" rules="required|min:6">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-group mb-3 form-group">
            <input type="password" class="form-control"
              placeholder="Nhập lại mật khẩu" name="password_confirmation"
              rules="required|min:6|confirm:password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>

        <p class="mt-2">
          <a href="{{ route('login') }}" class="text-center">Tôi đã có tài
            khoản</a>
        </p>
      </div>
    </div>
  </div>
</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
<script>
  $(function() {
    if ($('#type').val() == 2) {
      $('#organize').removeClass('d-none')
      $('#personal').addClass('d-none')
      $('#organize').find('input').attr('rules', 'required')
    } else {
      $('#organize').addClass('d-none')
      $('#personal').removeClass('d-none')
      $('#personal').find('input').attr('rules', 'required')
    }
    new Validator('form');

    $('#type').change(function() {
      if ($(this).val() == 2) {
        $('#organize').removeClass('d-none')
        $('#personal').addClass('d-none')
        $('#personal').find('input').removeAttr('rules')
        $('#organize').find('input').attr('rules', 'required')
        new Validator('form');
      } else {
        $('#organize').addClass('d-none')
        $('#personal').removeClass('d-none')
        $('#organize').find('input').removeAttr('rules')
        $('#personal').find('input').attr('rules', 'required')
        new Validator('form');
      }
    })
  })
</script>
@if (session('alert-success'))
<script>
  toastr.success("{{ session('alert-success') }}")
</script>
@endif
@if (session('alert-fail'))
<script>
  toastr.error("{{ session('alert-fail') }}")
</script>
@endif

</html>