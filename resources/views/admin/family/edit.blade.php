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
            </div>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('admin.family.update', ['id' => $family->id]) }}">
              @csrf
              @method('put')
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="holdhouse_id">Mã hộ khẩu:</label>
                  <input type="text" class="form-control" id="holdhouse_id" name="holdhouse_id"
                    value="{{ $family->holdhouse_id }}" rules="required|numeric">
                </div>
                @error('holdhouse_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-row">
                {{-- Name --}}
                <div class="form-group col-md-3">
                  <label for="owner_name">Tên chủ hộ:</label>
                  <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name"
                    name="owner_name" value="{{ old('owner_name') ?? $family->owner_name }}" rules="required">
                  @error('owner_name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-3">
                  <label for="person_qty">Số nhân khẩu:</label>
                  <input type="number" class="form-control @error('person_qty') is-invalid @enderror" id="person_qty"
                    name="person_qty" value="{{ old('person_qty') ?? $family->person_qty }}" rules="required|integer|min:1">
                  @error('person_qty')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="address">Địa chỉ:</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address') ?? $family->address }}" rules="required">
                  @error('address')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="ward">Xã:</label>
                  <select id="ward" class="form-control select2 @error('ward_id') is-invalid @enderror" name="ward_id">
                    @foreach ($wards as $item)
                    <option value="{{ $item->id }}" @if ($item->id === $family->ward_id) selected @endif
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
              </div>
              <a class="btn btn-default mr-1" href="{{ route('admin.family.index') }}">Quay lại</a>
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
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}">
  </script>
  <script src="{{ asset('js/vi.js') }}"></script>
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      $('.select2').select2()
      const validator = new Validator('form');
    })
  </script>
@endsection