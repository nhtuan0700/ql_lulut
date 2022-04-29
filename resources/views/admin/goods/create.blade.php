@extends('admin.master')
@section('title')
  Quản lý hàng cứu trợ
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex  align-items-center">
                <span class="card-title mr-2">Tạo mới</span>
              </div>
            </div>

            <div class="card-body">
              <form method="POST" action="{{ route('admin.goods.store') }}">
                @csrf
                <div class="form-row">
                  {{-- Name --}}
                  <div class="form-group col-md-3">
                    <label for="name">Tên:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                      value="{{ old('name') }}" rules="required">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="unit">Đơn vị:</label>
                    <select id="unit" class="form-control @error('unit') is-invalid @enderror" name="unit">
                      @foreach ($unitList as $key => $unit)
                        @if ($unit === old('unit'))
                          <option value="{{ $key }}" selected>{{ $unit }}</option>
                        @else
                          <option value="{{ $key }}">{{ $unit }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('unit')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label for="qty">Số lượng:</label>
                    <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty"
                      value="{{ old('qty') ?? 0 }}" rules="required|integer|min:0">
                    @error('qty')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <a class="btn btn-default mr-1" href="{{ route('admin.goods.index') }}">Quay lại</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
  <script src="{{ asset('js/validator.js') }}"></script>
  <script>
    $(function() {
      const validator = new Validator('form');
    })
  </script>
@endsection