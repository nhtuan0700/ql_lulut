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
              <div class="d-flex  align-items-center">
                <span class="card-title mr-2">Chi tiết</span>
                <a href="{{ route('admin.user.reset_password', ['id' => $user->id]) }}" class="btn btn-secondary mr-2">Đặt lại
                  mật khẩu</a>
              </div>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('admin.user.update', ['id' => $user->id]) }}">
                @csrf
                @method('put')
                <div class="form-row">
                  {{-- ID --}}
                  <div class="form-group col-md-3">
                    <label for="id">Mã:</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" disabled>
                  </div>
                  {{-- Created at --}}
                  <div class="form-group col-md-3">
                    <label for="created_at">Thời gian tạo</label>
                    <input type="text" class="form-control" id="created_at" name="created_at"
                      value="{{ $user->created_at }}" disabled>
                  </div>
                </div>
                <div class="form-row">
                  {{-- Name --}}
                  <div class="form-group col-md-3">
                    <label for="name">Họ Tên:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                      value="{{ old('name') ? old('name') : $user->info->name }}" rules="required">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="card_id">CMND:</label>
                    <input type="text" class="form-control @error('card_id') is-invalid @enderror" id="card_id"
                      name="card_id" value="{{ old('card_id') ? old('card_id') : $user->info->card_id }}" maxlength="9" rules="required">
                    @error('card_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  
                  {{-- Phone number --}}
                  <div class="form-group col-md-3">
                    <label for="phone_number">Số điện thoại:</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number"
                      value="{{ old('phone_number') ? old('phone_number') : $user->info->phone_number }}" maxlength="10" rules="required|phone">
                    @error('phone_number')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="dob">Ngày sinh:</label>
                    <div class="input-group date" id="dob" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="dob"
                        autocomplete="off"  rules="required"/>
                      <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                    @error('dob')
                      <div class="invalid-feedback d-block">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                </div>
                <div class="form-row">
                  {{-- Email --}}
                  <div class="form-group col-md-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                      value="{{ $user->email }}" disabled>
                  </div>
                  
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="ward">Xã:</label>
                    <select id="ward" class="form-control select2 @error('ward_id') is-invalid @enderror"
                      name="ward_id">
                      @foreach ($wards as $item)
                        <option value="{{ $item->id }}" @if ($item->id === $user->ward_id) selected @endif
                          data-room="{{ $item->is_room }}">
                          {{ $item->name }}
                        </option>
                      @endforeach

                      @error('ward_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </select>
                  </div>
                  {{-- Role --}}
                  <div class="form-group col-md-3">
                    <label for="role">Vai trò:</label>
                    <select id="role" class="form-control @error('role_id') is-invalid @enderror" name="role_id">
                      @foreach ($roles as $role)
                        @if ($role->id == $user->role->id)
                          <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
      $('.select2').select2()
      const validator = new Validator('form');
      $('#dob').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi',
        format: 'L'
      });
      var d = new Date()
      var dob = `{{ old('dob') }}` || `{{ $user->info->dob }}`
      $("#dob input").val(dob);
      
    })
  </script>
@endsection
