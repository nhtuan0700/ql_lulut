@extends('admin.master')
@section('title')
  Quản lý người dùng
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div>
                <p class="card-title mr-3">Tạo mới</p>
              </div>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('admin.user.create') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="name">Họ Tên:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                      value="{{ old('name') }}" rules="required">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dob">Ngày sinh:</label>
                    <div class="input-group date" id="dob" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob"
                        autocomplete="off" rules="required"/>
                      <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    @error('dob')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  

                  <div class="form-group col-md-3">
                    <label for="card_id">CMND:</label>
                    <input type="text" class="form-control @error('card_id') is-invalid @enderror" id="card_id"
                      name="card_id" value="{{ old('card_id') }}" maxlength="9" autocomplete="off" rules="required">
                    @error('card_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="phone_number">Số điện thoại:</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number"
                      value="{{ old('phone_number') }}" maxlength="10" autocomplete="off" rules="required|phone" type="number">
                    @error('phone_number')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                      value="{{ old('email') }}" rules="required">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                      name="password" rules="required|min:6">
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="ward_id">Xã:</label>
                    <select id="ward_id" class="form-control  @error('ward_id') is-invalid @enderror" name="ward_id">
                      @foreach ($wards as $ward)
                        <option value="{{ $ward->id }}" @if ($ward->id == old('ward_id')) selected @endif>
                          {{ $ward->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('ward_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="role">Vai trò:</label>
                    <select id="role" class="form-control  @error('role_id') is-invalid @enderror" name="role_id">
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if ($role->id == old('role_id')) selected @endif>
                          {{ $role->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('role_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <a class="btn btn-default mr-1" href="{{ route('admin.user.index') }}">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('tag_head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('script')
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('js/vi.js') }}"></script>
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      $('.select2').select2();
      const validator = new Validator('form');
      $('#dob').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi',
        format: 'L'
      });
      var d = new Date();
      var date = ("0" + d.getDate()).slice(-2);
      var month = ("0" + (d.getMonth() + 1)).slice(-2);
      var year = 2000;

      var dob = `{{ old('dob') }}` || `${date}/${month}/${year}`;
      $("#dob input").val(dob);
    })
  </script>
@endsection
