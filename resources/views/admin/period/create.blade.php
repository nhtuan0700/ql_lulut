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
                  id="name" name="name" value="{{ old('name')}}" maxlength="10"
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
                  value="{{ old('description')}}" maxlength="10">
                @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="date_start">Thời gian bắt đầu:</label>
                  <div class="input-group date" id="date_start"
                    data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input"
                      data-target="#date_start" name="date_start"
                      autocomplete="off" rules="required" />
                    <div class="input-group-append" data-target="#date_start"
                      data-toggle="datetimepicker">
                      <div class="input-group-text"><i
                          class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('date_start')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="date_end">Thời gian kết thúc:</label>
                  <div class="input-group date" id="date_end"
                    data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input"
                      data-target="#date_end" name="date_end" autocomplete="off"
                      rules="required" />
                    <div class="input-group-append" data-target="#date_end"
                      data-toggle="datetimepicker">
                      <div class="input-group-text"><i
                          class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  @error('date_end')
                  <div class="invalid-feedback d-block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
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
      $('#date_start').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        locale: 'vi',
        format: 'L',
      });
      var d = new Date();
      var date = ("0" + d.getDate()).slice(-2);
      var month = ("0" + (d.getMonth() + 1)).slice(-2);
      var year = d.getFullYear();

      var date_start = `{{ old('date_start') }}` || `${date}/${month}/${year}`;
      $("#date_start input").val(date_start);

      $('#date_end').datetimepicker({
        icons: {
          time: 'far fa-clock'
        },
        format: 'L',
        locale: 'vi'
      });

      var date_end = `{{ old('date_end') }}` || `${date}/${month}/${year}`;
      $("#date_end input").val(date_end);
    })
</script>
@endsection