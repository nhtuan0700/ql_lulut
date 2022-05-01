@extends('admin.master')
@section('title')
Quản lý đợt ủng hộ
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
            <form method="POST" action="{{ route('admin.period.store') }}">
              @csrf
              <div class="form-group">
                <label for="name">Tên đợt ủng hộ:</label>
                <input type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name" name="name" value="{{ old('name') ?? $period->name}}" maxlength="10"
                  rules="required|min:10">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="description">Mô tả:</label>
                <input type="text"
                  class="form-control @error('description') is-invalid @enderror"
                  id="description" name="description"
                  value="{{ old('description') ?? $period->description }}" maxlength="10">
                @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="start_at">Thời gian bắt đầu:</label>
                  <div class="input-group date" id="start_time"
                    data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input"
                      data-target="#start_time" name="start_time"
                      autocomplete="off" rules="required" />
                    <div class="input-group-append" data-target="#start_time"
                      data-toggle="datetimepicker">
                      <div class="input-group-text"><i
                          class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('start_time')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="end_time">Thời gian kết thúc:</label>
                  <div class="input-group date" id="end_time"
                    data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input"
                      data-target="#end_time" name="end_time" autocomplete="off"
                      rules="required" />
                    <div class="input-group-append" data-target="#end_time"
                      data-toggle="datetimepicker">
                      <div class="input-group-text"><i
                          class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('end_time')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('tag_head')
<link rel="stylesheet"
  href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script
  src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}">
</script>
<script src="{{ asset('js/vi.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
<script>
  $(function() {
      const validator = new Validator('form');
      $('#start_time').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi',
      });
      var d = new Date();
      var date = ("0" + d.getDate()).slice(-2);
      var month = ("0" + (d.getMonth() + 1)).slice(-2);
      var year = d.getFullYear();

      var start_time = `{{ old('start_time') }}` || `${date}/${month}/${year} 00:00`;
      $("#start_time input").val(start_time);

      $('#end_time').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi'
      });

      var end_time = `{{ old('end_time') }}` || `${date}/${month}/${year} 23:59`;
      $("#end_time input").val(end_time);
    })
</script>
@endsection