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
            <form method="POST" action="{{ route('admin.period.update', ['id' => $period->id]) }}">
              @csrf
              @method('put')
              <div class="form-group">
                <label for="name">Mã:</label>
                <input type="text" class="form-control" value="{{ $period->id }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Tên đợt ủng hộ:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                  value="{{ old('name') ?? $period->name}}" minlength="10" rules="required|min:10">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="name">Xã:</label>
                <input type="text" class="form-control" value="{{ $period->ward->name }}" readonly>
              </div>
              <div class="form-group">
                <label for="date_end">Thời gian kết thúc:</label>
                <div class="input-group date" id="date_end" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#date_end" name="date_end"
                    autocomplete="off" rules="required" value="{{ $period->date_end }}"/>
                  <div class="input-group-append" data-target="#date_end" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
                @error('date_end')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
              </div>
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
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}">
</script>
<script src="{{ asset('js/vi.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
<script>
  $(function () {
    const validator = new Validator('form')
    $('#start_time').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      locale: 'vi',
    })
    var d = new Date()
    var date = ("0" + d.getDate()).slice(-2)
    var month = ("0" + (d.getMonth() + 1)).slice(-2)
    var year = d.getFullYear()

    $('#date_end').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      locale: 'vi',
      format: 'L',
    })

    var date_end = `{{ old('date_end') }}` || `{{ $period->date_end }}`
    $("#date_end input").val(date_end)
  })
</script>
@endsection